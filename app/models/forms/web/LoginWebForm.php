<?php
namespace app\models\forms\web;

use Yii;
use yii\base\Model;
use app\models\CustomersAuth as User;

/**
 * Login form
 */
class LoginWebForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;
    public $origin;
    public $id;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['origin', 'id'], 'string'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password) || ($user->email != $this->email) || $user->isBlocked) {
                $this->addError(
                    'email',
                    Yii::t('app', 'Correo o contraseña incorrecta.')
                );
            }
        }
    }

    /**
     * model attribute labels
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Correo'),
            'password' => Yii::t('app', 'Contraseña'),
            'rememberMe' => Yii::t('app', 'Recordarme')
        ];
    }

    /**
     * Inicia la sesión de un usuario en web
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {            
            $this->getUser()->updateAttributes([
                'last_login_at' => time(),
                'last_login_ip' => Yii::$app->request->getUserIP()
            ]);
            
            return Yii::$app->user->login(
                $this->getUser(),
                $this->rememberMe ? 3600 * 24 * 30 : 0
            );
        } else {
            $this->addError(
                'email',
                Yii::t('app', 'Correo o contraseña incorrecta.')
            );
            return false;
        }
    }

    /**
     * Finds user by [[email]]
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
