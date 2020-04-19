<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_items".
 *
 * @property int $id
 * @property int $menu_item_id
 * @property int $customer_auth_id
 * @property int $sale_id
 * @property int $quantity
 * @property string $created_at
 */
class SaleItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu_item_id', 'customer_auth_id', 'quantity', 'created_at'], 'required'],
            [['menu_item_id', 'customer_auth_id', 'sale_id', 'quantity'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'menu_item_id' => Yii::t('app', 'Id del platillo/bebida'),
            'customer_auth_id' => Yii::t('app', 'Cliente'),
            'sale_id' => Yii::t('app', 'Venta'),
            'quantity' => Yii::t('app', 'Cantidad'),
            'created_at' => Yii::t('app', 'Creado el'),
        ];
    }

    /**
     * [getMenuItem description]
     * @return  [type]  [return description]
     */
    public function getMenuItem()
    {
        return $this->hasOne(MenuItems::class, ['id' => 'menu_item_id']);
    }
}
