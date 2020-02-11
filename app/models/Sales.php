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
            [['user_id', 'order_folio', 'status', 'active', 'created_at', 'created_by'], 'required'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'order_folio' => Yii::t('app', 'Order Folio'),
            'status' => Yii::t('app', 'Status'),
            'active' => Yii::t('app', 'Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }
}
