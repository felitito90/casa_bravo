<?php

namespace app\controllers\web;

use app\models\MenuItems;
use app\models\SaleItems;
use app\models\search\MenuItemsSearch;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class MenuItemsController extends \yii\web\Controller
{
    /**
     * All the items menu sort by id
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MenuItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination = ['pageSize' => 10];

        $menuItems = $dataProvider->getModels();
        $pages = new Pagination([
            'totalCount' => $dataProvider->getTotalCount(),
            'pageSize' => 10
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'menuItems' => $menuItems,
            'pages' => $pages,
        ]);
    }

    /**
     * [actionOrder description]
     * @param   int  $menuItem  [$menuItem description]
     * @param   int  $quantity  [$quantity description]
     */
    public function actionOrder(int $menuItem, int $quantity)
    {
        if ($quantity > 0) {
            $existingItem = SaleItems::findOne([
                'customer_auth_id' => Yii::$app->user->identity->id,
                'menu_item_id' => $menuItem,
            ]);

            if (!is_null($existingItem)) { // NOTE: If an item exist that would be updated
                $existingItem->quantity = $quantity;

                if ($existingItem->update()) {
                    return json_encode(['saleItem' => (array) $existingItem]);
                }
            }

            $saleItem = new SaleItems();
            $saleItem->customer_auth_id = Yii::$app->user->identity->id;
            $saleItem->menu_item_id = $menuItem;
            $saleItem->quantity = $quantity;
            $saleItem->created_at = date('Y-m-d H:i:s');
    
            if ($saleItem->validate()) {
                $saleItem->save();
    
                return json_encode(['saleItem' => (array) $saleItem]);
            }
        }

        return json_encode(['error' => false]);
    }

    /**
     * [actionView description]
     * @param int $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * [findModel find the instance]
     * @param  int  $id
     * @return  object
     */
    protected function findModel($id)
    {
        if (!is_null($model = MenuItems::findOne($id))) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página que usted solicitó no existe.'));
    }
}
