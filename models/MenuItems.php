<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu_items".
 *
 * @property int $id
 * @property string|null $item_name
 * @property float|null $price
 * @property string|null $description
 * @property string|null $item_photo
 * @property int|null $active
 * @property string|null $created_at
 * @property int|null $created_by
 */
class MenuItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['description', 'item_photo'], 'string'],
            [['active', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['item_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_name' => Yii::t('app', 'Nombre del platillo/Bebida'),
            'price' => Yii::t('app', 'Price'),
            'description' => Yii::t('app', 'Description'),
            'item_photo' => Yii::t('app', 'Item Photo'),
            'active' => Yii::t('app', 'Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }
}
