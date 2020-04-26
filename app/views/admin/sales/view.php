<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sales */

$this->title = Yii::t('app', 'Orden') . ' ' . $model->order_folio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Órdenes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sales-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'customer.email',
                    'order_folio',
                    'status',
                    'active:boolean',
                    'created_at:datetime',
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'showPageSummary' => true,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'menuItem.item_name',
                    [
                        'attribute' => 'menuItem.itemPhoto',
                        'label' => 'Foto',
                        'value' => function ($model) {
                            return Html::img($model->menuItem->itemPhoto, [
                                'width' => 100,
                                'height' => 100
                            ]);
                        },
                        'format' => 'html'
                    ],
                    'quantity',
                    [
                        'attribute' => 'menuItem.price',
                        'label' => Yii::t('app', 'Precio'),
                        'value' => function ($model) {
                            return $model->menuItem->price;
                        },
                        'format' => ['decimal', 2],
                        'pageSummary' => 'Total',
                    ],
                    [
                        'attribute' => 'saleItemTotal',
                        'label' => Yii::t('app', 'Total'),
                        'value' => function ($model) {
                            return $model->saleItemTotal;
                        },
                        'format' => ['decimal', 2],
                        'pageSummary' => true
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>