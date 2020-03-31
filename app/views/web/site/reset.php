<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'template' =>  '<div class="input-group"><span class="input-group-addon"><i class="fa fa-key mx-auto" style="color: black;"></i></span>{input}</div>'
];

$fieldOptions2 = [
    'template' =>  '<div class="input-group"><span class="input-group-addon"><i class="fa fa-key mx-auto" style="color: black;"></i></span>{input}</div>'
];
?>
<div class="row">
    <div class="col-12 col-sm-12">
        <div id="login-box">
            <div id="login-box-holder">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <header id="login-header">
                            <div id="login-logo">
                                <img src="<?= Yii::getAlias('@web') ?>/img/casa-bravo.png" />
                            </div>
                        </header>
                        <div id="login-box-inner">
                            <?php $form = ActiveForm::begin([
                                'id' => $model->formName(),
                                'enableClientScript' => false,
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => false,
                                'options' => [
                                    'autocomplete' => 'off'
                                ],
                            ]); ?>

                            <?= $form->errorSummary($model, [
                                'class' => 'alert alert-danger'
                            ]); ?>

                            <?= $form->field($model, 'password', $fieldOptions1)->passwordInput([
                                'id' => 'password',
                                'class' => 'form-control',
                            ])->label(false) ?>

                            <?= $form->field($model, 'password_confirm', $fieldOptions2)->passwordInput([
                                'id' => 'password2',
                                'class' => 'form-control',
                            ])->label(false) ?>
                            <div id="pass-info" class="clearfix"></div>

                            <?= Html::submitButton(Yii::t('app', 'Recuperar'), [
                                'class' => 'btn btn-outline-success btn-block',
                                'tabindex' => '3'
                            ]) ?>

                            <br>
                            <?= Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('app', 'Regresar'), ['/site/login'], [
                                'tabindex' => '5',
                            ]) ?>
                            <hr>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>