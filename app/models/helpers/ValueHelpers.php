<?php

namespace app\models\helpers;

use Yii;
use yii\db\Query;

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
            'customer_auth_id' => Yii::$app->user->identity->id,
            'sale_id' => 0
        ])
        ->scalar();

        return $total;
    }

    /**
     * [getOrderedProductsTotal description]
     * @return  string  [return description]
     */
    public static function getOrderedProductsTotal(): string
    {
        $query = new Query();
        $total = $query->select('SUM((menu_items.price * sale_items.quantity)) as total')
            ->from('sale_items')
            ->innerJoin('menu_items', 'sale_items.menu_item_id = menu_items.id')
            ->where([
                'sale_items.sale_id' => 0,
                'sale_items.customer_auth_id' => Yii::$app->user->identity->id,
            ])
            ->one();
            
        return !is_null($total['total']) ? $total['total'] : 0;
    }
}