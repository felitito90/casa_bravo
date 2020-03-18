<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "customers".
 *
 * @property int $id
 * @property int $customers_auth_id
 * @property string $folio
 * @property string $first_name
 * @property string $last_name
 * @property int $sex
 * @property string $phone
 * @property int $active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CustomersAuth $customersAuth
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customers_auth_id', 'folio', 'first_name', 'last_name'], 'required'],
            [['customers_auth_id', 'sex', 'active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['folio'], 'string', 'max' => 20],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 18],
            [['customers_auth_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomersAuth::class, 'targetAttribute' => ['customers_auth_id' => 'id']],
        ];
    }

    /**
    * behaviors
    */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
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
            'id' => Yii::t('app', 'ID'),
            'customers_auth_id' => Yii::t('app', 'ID de usuario'),
            'folio' => Yii::t('app', 'Folio'),
            'first_name' => Yii::t('app', 'Nombres'),
            'last_name' => Yii::t('app', 'Apellidos'),
            'sex' => Yii::t('app', 'Sexo'),
            'phone' => Yii::t('app', 'Teléfono'),
            'active' => Yii::t('app', 'Activo'),
            'created_at' => Yii::t('app', 'Registrado el'),
            'updated_at' => Yii::t('app', 'Perfil actualizado el'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomersAuth()
    {
        return $this->hasOne(CustomersAuth::class, ['id' => 'customers_auth_id']);
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return ($this->sex == 1) ? Yii::t('app', 'Hombre') : Yii::t('app', 'Mujer');
    }

    /**
     * @return array
     */
    public function getAgenciesList()
    {
        $agencies = $this->find()
            ->select(['id', 'CONCAT(first_name, " ", last_name) as full_name'])
            ->where(['active' => 1])
            ->asArray()
            ->all();

        return ArrayHelper::map($agencies, 'id', 'full_name');
    }

    /**
     * [setFolio description]
     * @return  void  $this->folio the attribute of the folio
     */
    public function setFolio()
    {
        $today = date('Y-m-d H:i:s', strtotime('today'));
        $todaylastsecond = date('Y-m-d H:i:s', strtotime('tomorrow') - 1);

        $customersDay = static::find()
            ->where(['between', 'created_at', $today, $todaylastsecond])
            ->count();

        $this->folio = 'CUS' . date('y') . date('m') . date('d') . str_pad(($customersDay + 1), 2, '0', STR_PAD_LEFT);
    }
}
