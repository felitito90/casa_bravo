<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth".
 *
 * @property string $id
 * @property string $customer_auth_id
 * @property string $source
 * @property string $source_id
 *
 * @property User $user
 */
class Auth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_auth_id', 'source', 'source_id'], 'required'],
            [['customer_auth_id'], 'integer'],
            [['source', 'source_id'], 'string', 'max' => 255],
            [['customer_auth_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomersAuth::class, 'targetAttribute' => ['customer_auth_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_auth_id' => 'User ID',
            'source' => 'Source',
            'source_id' => 'Source ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(CustomersAuth::className(), ['id' => 'customer_auth_id']);
    }
}
