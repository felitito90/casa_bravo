<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Expression;
use yii\helpers\Html;

/**
 * This is the model class for table "customers_auth".
 *
 * @property int $id
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $security_token
 * @property string $registration_ip
 * @property int $confirmed_at
 * @property int $blocked_at
 * @property int $last_login_at
 * @property string $last_login_ip
 * @property int $password_changed_at
 * @property int $lfpdppp_consent
 * @property int $lfpdppp_consent_date
 * @property int $lfpdppp_deleted
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Customers[] $customer
 */
class CustomersAuth extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_REGISTER = 'register';
    const SCENARIO_CREATE = 'create';
    const SCENARIO_CHNGPSW = 'chngpsw';

    public $currentPassword;
    public $newPassword;
    public $newPasswordConfirm;

    public $fullName;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers_auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'on' => self::SCENARIO_CREATE],
            ['email', 'trim'],
            ['email', 'email'],
            ['fullName', 'string'],
            [
                'email',
                'unique',
                'message' => Yii::t('app', 'Esta dirección de correo electrónico ya ha sido tomada'),
                'on' => self::SCENARIO_REGISTER
            ],
            [['newPassword', 'currentPassword', 'newPasswordConfirm'], 'required', 'on' => self::SCENARIO_CHNGPSW],
            [['currentPassword'], 'validateCurrentPassword', 'on' => self::SCENARIO_CHNGPSW],

            [['newPassword', 'newPasswordConfirm'], 'string', 'min' => 6, 'on' => self::SCENARIO_CHNGPSW],
            [['newPassword', 'newPasswordConfirm'], 'filter', 'filter' => 'trim'],
            [
                ['newPasswordConfirm'],
                'compare',
                'compareAttribute' => 'newPassword',
                'message' => Yii::t('app', 'Las claves no coinciden'),
                'on' => self::SCENARIO_CHNGPSW
            ],
        ];
    }

    /**
    * behaviors
    */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'email' => Yii::t('app', 'Correo electrónico'),
            'auth_key' =>  Yii::t('app', 'Llave de autenticación'),
            'password_hash' => Yii::t('app', 'Contraseña'),
            'security_token' =>  Yii::t('app', 'Token de seguridad'),
            'registration_ip' => Yii::t('app', 'IP de registro'),
            'confirmed_at' => Yii::t('app', 'Confirmado el'),
            'blocked_at' => Yii::t('app', 'Bloqueado el'),
            'last_login_at' => Yii::t('app', 'Último acceso'),
            'last_login_ip' => Yii::t('app', 'IP último acceso'),
            'password_changed_at' => Yii::t('app', 'Contraseña actualizada el'),
            'lfpdppp_consent' => Yii::t('app', 'Lfpdppp aprobado'),
            'lfpdppp_consent_date' => Yii::t('app', 'Lfpdppp aprobado el'),
            'lfpdppp_deleted' => Yii::t('app', 'Lfpdppp borrado'),
            'updated_at' => Yii::t('app', 'Actualizado el'),
            'created_at' => Yii::t('app', 'Creado el'),
            'newPassword' => Yii::t('app', 'Nueva contraseña'),
            'newPasswordConfirm' => Yii::t('app', 'Confirmar nueva contraseña'),
            'currentPassword' => Yii::t('app', 'Contraseña actual'),
        ];
    }

    /**
     * [validateCurrentPassword description]
     * @return  int
     */
    public function validateCurrentPassword()
    {
        if (!$this->verifyPassword($this->currentPassword)) $this->addError('currentPassword', Yii::t('app', 'Contraseña actual incorrecta'));
    }

    /**
     * @param $password
     * @return bool
     */
    public function verifyPassword($password)
    {
        $dbpassword = static::findOne([
            'email' => Yii::$app->user->identity->email
        ])->password_hash;

        return Yii::$app->security->validatePassword($password, $dbpassword);
    }

    /**
     * @param int|string $id
     * @return array|ActiveRecord|IdentityInterface|null
     */
    public static function findIdentity($id)
    {
        return static::find()
            ->where(['id' => $id])
            ->andWhere(['IS NOT', 'confirmed_at', null])->one();
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void|IdentityInterface|null
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @param $email
     * @return array|ActiveRecord|null
     */
    public static function findByEmail($email)
    {
        return static::find()
            ->where(['email' => $email])
            ->andWhere(['IS NOT', 'confirmed_at', null])
            ->one();
    }

    /**
     * @param $email
     * @return array|ActiveRecord|null
     */
    public static function findByEmailUnconfirmed($email)
    {
        return static::find()
            ->where(['email' => $email])
            ->andWhere(['confirmed_at' => null])
            ->one();
    }

    /**
    * Finds user by security token
    * @param string $token security token
    * @return static|null
    */
    public static function findBySecurityToken($token)
    {
        if (!static::isSecurityTokenValid($token)) return null;

        return static::findOne(['security_token' => $token]);
    }

    /**
    * Finds out if security token is valid
    * @param string $token security token
    * @return boolean
    */
    public static function isSecurityTokenValid($token)
    {
        if (empty($token)) return false;
        
        // El token no expira.
        return true;
    }

    /**
    * @getId
    */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
    * @getAuthKey
    */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
    * @validateAuthKey
    */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
    * Validates password
    * @param string $password password to validate
    * @return boolean if password provided is valid for current user
    */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @param $password
     * @throws Exception
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @throws Exception
     */
    public function generateSecurityToken()
    {
        $this->security_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
    * Removes password reset token
    */
    public function removeSecurityToken()
    {
        $this->security_token = null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::class, ['customers_auth_id' => 'id']);
    }

    /**
     * @param $attribute
     * @param int $length
     * @return string
     * @throws Exception
     */
    public function generateUniqueRandomString($attribute, $length = 32)
    {
        $randomString = Yii::$app->getSecurity()->generateRandomString($length);

        if (!$this->findOne([$attribute => $randomString])) {
            return $randomString;
        }

        return $this->generateUniqueRandomString($attribute, $length);
    }

    /**
     * @return bool whether is blocked or not
     */
    public function getIsBlocked()
    {
        return $this->blocked_at !== null;
    }

    /**
     * @return array the rowOptions for gridview
     */
    public function getRowCss()
    {   
        $rowCss = [];

        if (!is_null($this->blocked_at)) {
            $rowCss = ['class' => 'danger'];
        }

        return $rowCss;
    }

    /**
     * @return  string
     */
    public function getConfirmedAt()
    {
        if (is_null($this->confirmed_at)) { 
            return Html::tag('span', Yii::t('app', 'Sin confirmar'), [
                'class' => 'badge',
                'style' => 'background-color: #bb2124; color:white;'
            ]);
        }
        
        return date('d/m/Y h:i:s', $this->confirmed_at);
    }
}
