<?php

namespace app\components;

use app\models\Auth;
use app\models\CustomersAuth;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $attributes = $this->client->getUserAttributes();
        $idAttr = 'id';
        switch ($this->client->name) {
            case 'google':
                $emailAttr = 'emails.0.value';
                $nameAttr = 'displayName';
                break;

            default:
                $emailAttr = 'email';
                $nameAttr = 'name';
        }
        
        $email = ArrayHelper::getValue($attributes, $emailAttr);
        $id = ArrayHelper::getValue($attributes, $idAttr);

        /* @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $this->client->getId(),
            'source_id' => $id,
        ])->one();

        if (empty($email)) {
            Yii::$app->getSession()->setFlash(
                'error',
                Yii::t('app', 'Incapaz de ingresar al usuario. No se encontró un email.')
            );
            return false;
        }

        if ($auth) { // login
            /* @var User $user */
            $user = $auth->user;
            if ($this->updateUserInfo($user)) {
                Yii::$app->user->login($user, 3600 * 24 * 30);
            } else {
                Yii::$app->getSession()->setFlash(
                    'error',
                    Yii::t('app', 'Incapaz de ingresar al usuario')
                );
            }
        } else { // signup
            $existingUser = CustomersAuth::findOne(['email' => $email]);
            if ($existingUser) {
                $auth = new Auth([
                    'customer_auth_id' => $existingUser->id,
                    'source' => $this->client->getId(),
                    'source_id' => (string) $id,
                ]);
                if ($this->updateUserInfo($existingUser) && $auth->save()) {
                    Yii::$app->user->login($existingUser, 3600 * 24 * 30);
                } else {
                    Yii::$app->getSession()->setFlash(
                        'error',
                        Yii::t('app', 'Incapaz de guardar la cuenta {client}: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($auth->getErrors()),
                        ])
                    );
                }
            } else {
                $password = Yii::$app->security->generateRandomString(12);
                $user = new CustomersAuth([
                    'email' => $email,
                    'password_hash' => $password,
                    'auth_key' => Yii::$app->security->generateRandomString(),
                    'registration_ip' => Yii::$app->request->getUserIP(),
                    'password_changed_at' => time(),
                    'confirmed_at' => time()
                ]);

                $transaction = CustomersAuth::getDb()->beginTransaction();

                if ($user->save()) {
                    $auth = new Auth([
                        'customer_auth_id' => $user->id,
                        'source' => $this->client->getId(),
                        'source_id' => (string) $id,
                    ]);
                    if ($auth->save()) {
                        $transaction->commit();
                        Yii::$app->user->login($user, 3600 * 24 * 30);
                    } else {
                        $transaction->rollBack();
                        Yii::$app->getSession()->setFlash(
                            'error',
                            Yii::t('app', 'Incapaz de salvar la cuenta de {client}: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($auth->getErrors()),
                            ])
                        );
                    }
                } else {
                    $transaction->rollBack();
                    Yii::$app->getSession()->setFlash(
                        'error',
                        Yii::t('app', 'Incapaz de guardar al usuario: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($user->getErrors()),
                        ])
                    );
                }
            }
        }
    }

    /**
     * @param CustomersAuth $user
     */
    private function updateUserInfo(CustomersAuth $user)
    {
        $password = Yii::$app->security->generateRandomString(60);
        $user->password = $password;
        return $user->save();
    }
}
