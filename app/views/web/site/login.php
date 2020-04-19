<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

$fieldOptions1 = [
    'template' =>  '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user" style="color: black;"></i></span>{input}</div>'
];

$fieldOptions2 = [
    'template' =>  '<div class="input-group"><span class="input-group-addon"><i class="fa fa-key mx-auto" style="color: black;"></i></span>{input}</div>'
];

$fieldOptions3 = [
    'template' => '<div class="checkbox-nice">{input}</div><label for="remember-me">Remember me</label>'
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
                                'id' => 'login-form',
                                'layout' => 'horizontal',
                                'fieldConfig' => [
                                    'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                                ],
                            ]); ?>

                            <?= $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>

                            <?= $form->field($model, 'email', $fieldOptions1)->textInput([
                                'autofocus' => true,
                                'placeholder' => Yii::t('app', 'Correo electrónico')
                            ]) ?>

                            <?= $form->field($model, 'password', $fieldOptions2)->passwordInput([
                                'placeholder' => Yii::t('app', 'Contraseña')
                            ]) ?>

                            <div class="checkbox-nice">
                                <?= $form->field($model, 'rememberMe', $fieldOptions3)->checkbox([
                                    'template' => "<div class=\"col-lg-3\">{input}{label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                ]) ?>
                            </div>

                            <?= Html::submitButton(Yii::t('app', 'Ingresar'), ['class' => 'btn btn-default btn-block', 'tabindex' => '3']) ?>

                            <div class="row">
                                <?= Html::a(
                                    Yii::t('app', '¿Olvidó su contraseña?'),
                                    ['/site/request-password-reset'],
                                    [
                                        'style' => 'font-size: 10px',
                                        'class' => 'btn btn-outline-danger btn-block'
                                    ]
                                ) ?>
                            </div>
                            <div class="row">
                                <?= Html::a(
                                    Yii::t('app', 'Registrarse'),
                                    ['/site/signup'],
                                    [
                                        'style' => 'font-size: 10px',
                                        'class' => 'btn btn-outline-primary btn-block'
                                    ]
                                ) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                            <?= Html::a('<i class="fa fa-facebook-square"></i> ' . Yii::t('app', 'Ingresar'), ['/site/auth', 'authclient' => 'facebook'], ['class' => 'btn btn-outline-primary btn-block']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>