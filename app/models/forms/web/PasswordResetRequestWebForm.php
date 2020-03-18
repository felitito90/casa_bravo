<?php
namespace app\models\forms\web;

use Yii;
use yii\base\Model;
use app\models\CustomersAuth;
use SideKit\Config\ConfigKit;

/**
 * Password reset request form
 */
class PasswordResetRequestWebForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\CustomersAuth',
                // 'filter' => ['IS NOT', 'confirmed_at', null],
                'message' => Yii::t('app', 'Correo electrónico no registrado.'),
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = CustomersAuth::findOne([
            'email' => $this->email,
            // ['IS NOT', 'confirmed_at', null],
        ]);

        if (!$user) {
            return false;
        }

        if (!CustomersAuth::isSecurityTokenValid($user->security_token)) {
            $user->generateSecurityToken();

            if (!$user->save()) {
                return false;
            }
        }

        $body = Yii::$app->view->renderFile('@app/views/mail/web/web-recovery.php', [
            'user' => $user
        ]);

        return Yii::$app->sendMail->sendIn(
            ConfigKit::env()->get('APP_SERVCLI_EMAIL'),
            $this->email,
            'Recuperación de contraseña para ' . Yii::$app->name,
            $body,
            '',
            2
        );
    }
}
