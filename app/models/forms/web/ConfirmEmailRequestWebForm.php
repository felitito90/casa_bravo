<?php
namespace app\models\forms\web;

use Yii;
use yii\base\Model;
use app\models\CustomersAuth;
use SideKit\Config\ConfigKit;

/**
 * Confirm email request form
 */
class ConfirmEmailRequestWebForm extends Model
{
    public $email;
    public $origin;
    public $id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [['origin', 'id'], 'string'],
            ['email', 'exist',
                'targetClass' => '\app\models\CustomersAuth',
                // 'filter' => ['IS NOT', 'confirmed_at', null],
                'message' => Yii::t('app', 'Correo electrónico no registrado.'),
            ],
        ];
    }

    /**
     * Sends an email with a link, for confirm.
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user CustomersAuth */
        $user = CustomersAuth::findByEmailUnconfirmed($this->email);

        if (!$user) {
            return false;
        }

        if (!is_null($user->confirmed_at)) {
            $this->addError('email', Yii::t('app', 'El email ya se encuentra confirmado.'));
            return false;
        }

        if (!CustomersAuth::isSecurityTokenValid($user->security_token)) {
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
