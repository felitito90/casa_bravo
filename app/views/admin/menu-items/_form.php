<?php

use kartik\touchspin\TouchSpin;
use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MenuItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6 col-xs-6 col-sm-6">
            <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'price')->widget(TouchSpin::classname(), [
                'options' => ['placeholder' => Yii::t('app', 'Seleccionar precio')],
                'pluginOptions' => [
                    'initval' => 3.00,
                    'min' => 1,
                    'step' => 0.1,
                    'decimals' => 2,
                    'boostat' => 5,
                    'maxboostedstep' => 10,
                    'prefix' => '$',
                ],
            ]); ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6 col-xs-6 col-sm-6">
            <?= $form->field($model, 'item_photo')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
            ]); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-floppy-o" aria-hidden="true"></i> ' . Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
