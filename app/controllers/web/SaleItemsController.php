<?php

namespace app\controllers\web;

use app\models\helpers\ValueHelpers;
use Yii;
use app\models\SaleItems;
use app\models\Sales;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SaleItemsController implements the CRUD actions for SaleItems model.
 */
class SaleItemsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * Lists all SaleItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $saleItems = SaleItems::find()->where([
            'customer_auth_id' => Yii::$app->user->identity->id
        ])->all();

        return $this->render('index', [
            'saleItems' => $saleItems
        ]);
    }

    /**
     * Displays a single SaleItems model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SaleItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $model = new Sales();
            $model->loadDefaultValues();
            $model->user_id = Yii::$app->user->identity->id;
            $model->order_folio = '#' . Yii::$app->security->generateRandomString(9);
            $model->created_at = date('Y-m-d H:i:s');
            $model->created_by = Yii::$app->user->identity->id;

            if (!$model->save()) {
                $transaction->rollBack();
                throw new \Exception("Error Processing Request");
            }

            if (!(SaleItems::updateAll(['sale_id' => $model->id], 'sale_id = 0') > 1)) {
                throw new \Exception("Error al procesar los platillos/bebidas");
            }

            $transaction->commit();

            return $this->redirect(['/sales/view', 'id' => $model->id]);
        } catch (\Throwable $th) {
            $transaction->rollBack();
            throw $th;
        }
    }

    /**
     * Updates an existing SaleItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * [actionUpdateQuantity description]
     * @param int $id
     * @param int $quantity
     * @return object
     */
    public function actionUpdateQuantity($id, $quantity)
    {
        $model = $this->findModel($id);

        $model->quantity = $quantity;

        if (!$model->update(false)) {
            return json_encode(['error' => false]);
        }

        return json_encode([
            'success' => 'Cambiando cantidad a ' . $quantity,
            'total' => '$ ' . number_format(ValueHelpers::getOrderedProductsTotal(), 2 , '.', ',')
        ]);
    }

    /**
     * Deletes an existing SaleItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!$this->findModel($id)->delete()) {
            return json_encode(['error' => false]);
        }

        return json_encode([
            'success' => 'Objeto eliminado',
            'total' => '$ ' . number_format(ValueHelpers::getOrderedProductsTotal(), 2 , '.', ',')
        ]);
    }

    /**
     * Finds the SaleItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SaleItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (!is_null($model = SaleItems::findOne($id))) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página que ustéd solicitó no existe.'));
    }
}
