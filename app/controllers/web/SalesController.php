<?php

namespace app\controllers\web;

use app\models\Sales;
use app\models\search\SalesSearch;
use Yii;
use yii\web\NotFoundHttpException;

class SalesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new SalesSearch();
        $searchModel->user_id = Yii::$app->user->identity->id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * [findModel description]
     * @param   [type]  $id  [$id description]
     * @return  [type]       [return description]
     */
    protected function findModel(int $id)
    {
        if (!is_null($model = Sales::findOne($id))) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página que ustéd solicitó no existe.'));
    }
}
