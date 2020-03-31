<?php

namespace app\models\helpers;

use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class ValueHelpers
{
    /**
     * Getting the ordered products rightnow
     * @return  string  [return description]
     */
    public static function getOrderedProductsQuantity(): string
    {
        $query = new Query();
        $total = $query->select([
            'COUNT(*) as total'
        ])
        ->from(['sale_items'])
        ->where([
            'customer_auth_id' => Yii::$app->user->identity,
            'sale_id' => 0
        ])
        ->scalar();

        return $total;
    }
}