<?php
namespace app\models\forms\web;

use Yii;
use yii\base\Model;
use app\models\Travelers;
use app\models\TravelersAuth;
use SideKit\Config\ConfigKit;

/**
 * Signup form
 */
class SignupWebForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $password_confirm;

    //referrer
    public $origin;
    public $id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['origin', 'id'], 'string'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => '\app\models\TravelersAuth',
                'message' => Yii::t('app', 'Este correo ya ha sido registrado.')
            ],

            [['password', 'password_confirm'], 'required'],
            [['password', 'password_confirm'], 'filter', 'filter' => 'trim'],
            ['password', 'string', 'min' => 6],
            [
                ['password_confirm'],
                'compare',
                'compareAttribute' => 'password',
                'message' => Yii::t('app', 'Las claves no coinciden.')
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Correo'),
            'password' => Yii::t('app', 'Contraseña'),
            'password_confirm' => Yii::t('app', 'Confirmar contraseña'),
            'first_name' => Yii::t('app', 'Nombres'),
            'last_name' => Yii::t('app', 'Apellidos'),
        ];
    }

    /**
     * Signs user up.
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new TravelersAuth();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->registration_ip = Yii::$app->request->getUserIP();
        $user->password_changed_at = time();

        if ($user->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $user->save(false);

                $traveler = new Travelers();
                $traveler->travelers_auth_id = $user->id;
                $traveler->avatar = 'avatar_photo_' . rand(1, 10) . '.svg';
                $traveler->setFolio();
                $traveler->first_name = $this->first_name;
                $traveler->last_name  = $this->last_name;
                $traveler->sex        = 1;
                $traveler->postcode   = '0';

                if ($traveler->validate()) {
                    $traveler->save(false);
                    $transaction->commit();

                    return $user;  // ok
                } else {
                    $transaction->rollBack();

                    $errores = $traveler->errors;
                    foreach ($errores as $error) {
                        foreach ($error as $mensaje) {
                            $this->addError('*', $mensaje);
                        }
                    }
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        } else {
            $errores = $user->errors;
            foreach ($errores as $error) {
                foreach ($error as $mensaje) {
                    $this->addError('*', $mensaje);
                }
            }
        }

        return null;
    }

    /**
     * Sends an email with a link, for email confirm.
     * @return boolean whether the email was send
     */
    public function sendEmail($user)
    {
        if (!$user) {
            return false;
        }

        if (!TravelersAuth::isSecurityTokenValid($user->security_token)) {
            $user->generateSecurityToken();
        }

        if (!$user->save()) {
            return false;
        }

        $body = Yii::$app->view->renderFile('@app/views/mail/web/web-signup.php', [
            'user' => $user,
            'origin' => $this->origin,
            'id' => $this->id,
        ]);

        return Yii::$app->sendMail->sendIn(
            ConfigKit::env()->get('APP_SERVCLI_EMAIL'),
            $this->email,
            'Confirmar correo para ' . Yii::$app->name,
            $body,
            '',
            2
        );
    }
}
