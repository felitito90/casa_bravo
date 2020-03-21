<?php
namespace app\models\forms\web;

use Yii;
use yii\base\Model;
use app\models\CustomersAuth;

/**
 * Password reset form
 */
class ResetPasswordWebForm extends Model
{
    public $password;
    public $password_confirm;

    /**
     * @var \common\models\CustomersAuth
     */
    private $_user;

    /**
     * Creates a form model given a token.
     * @param  string                          $token
     * @param  array                           $config name-value pairs that will be used to initialize the object properties
     * @throws \InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new \InvalidArgumentException(Yii::t('app', 'El token para recuperación de contraseña no debe estar en blanco.'));
        }
        $this->_user = CustomersAuth::findBySecurityToken($token);
        if (!$this->_user) {
            throw new \InvalidArgumentException(Yii::t('app', 'El token para recuperación de contraseña es incorrecto.'));
        }

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
     * Resets password.
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removeSecurityToken();

        return $user->save(false);
    }
}
