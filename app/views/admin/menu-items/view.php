<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MenuItems */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Platillos/Bebidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="menu-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn-group">
        <?= Html::a('<i class="fa fa-pencil"></i> ' . Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash"></i> ' . Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'item_name',
            'price',
            'description:ntext',
            [
                'attribute' => 'item_photo',
                'value' => function ($model) {
                    return Html::img($model->publicPhoto);
                },
                'format' => 'html'
            ],
            'active:boolean',
            'created_at:datetime',
            'created_by',
        ],
    ]) ?>

</div>