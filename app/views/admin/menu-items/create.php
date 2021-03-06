<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuItems */

$this->title = Yii::t('app', 'Nuevo platillo/Bebida');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-items-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>