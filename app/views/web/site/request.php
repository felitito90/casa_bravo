<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'template' =>  '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o" style="color: black;"></i></span>{input}</div>'
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
                            <?php $form = ActiveForm::begin(
                                [
                                    'id' => $model->formName(),
                                    'enableClientScript' => false,
                                    'enableAjaxValidation' => false,
                                    'enableClientValidation' => false,
                                ]
                            ); ?>
                            <?php $flashMessages = Yii::$app->session->getAllFlashes() ?>

                            <!-- Displaying all my flash messages inside a info box -->
                            <?php if ($flashMessages) { ?>
                                <?php foreach ($flashMessages as $key => $message) { ?>
                                    <?php if ($key == 'danger') { ?>
                                        <div class="alert alert-danger text-center" role="alert"><b><?= $message ?></b></div>
                                    <?php } elseif ($key == 'success') { ?>
                                        <div class="alert alert-success text-center" role="alert"><b><?= $message ?></b></div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>

                            <?= $form->errorSummary($model); ?>

                            <?= $form->field($model, 'email', $fieldOptions1)->textInput([
                                'placeholder' => Yii::t('app', 'Correo electrónico')
                            ])->label(false) ?>

                            <?= Html::submitButton(Yii::t('app', 'Continuar'), [
                                'class' => 'btn btn-block btn-outline-primary',
                                'tabindex' => '3'
                            ]) ?>
                            <br>
                            <?= Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('app', 'Regresar'), ['/site/login'], [
                                'tabindex' => '5',
                            ]) ?>
                            <hr>
                            <div class="text-center add_top_10">
                                <?= Yii::t('app', '¿Nuevo en Casa Bravo?') ?>
                                <strong>
                                    <?= Html::a(Yii::t('app', 'Regístrate'), ['/site/signup']) ?>
                                </strong>
                            </div><br>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>