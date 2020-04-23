<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property int $id
 * @property int $user_id
 * @property string $order_folio
 * @property int $status
 * @property int $active
 * @property string $created_at
 * @property int $created_by
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'order_folio', 'status', 'active'], 'required'],
            [['user_id', 'status', 'active', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['order_folio'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Cliente'),
            'order_folio' => Yii::t('app', 'Folio de la orden'),
            'status' => Yii::t('app', 'Estado'),
            'active' => Yii::t('app', 'Activo'),
            'created_at' => Yii::t('app', 'Creado el'),
            'created_by' => Yii::t('app', 'Creado por'),
        ];
    }

    /**
     * [getCustomer description]
     * @return object the customer
     */
    public function getCustomer()
    {
        return $this->hasOne(CustomersAuth::class, ['user_id' => 'id']);
    }
}
