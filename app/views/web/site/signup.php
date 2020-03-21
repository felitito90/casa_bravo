<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$this->title = Yii::t('app', 'Registrarse');

$fieldOptions1 = [
    'errorOptions' => [
        'class' => 'invalid-feedback',
        'style' => ['display' => 'block']
    ],
    'template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user" style="color: black;"></i></span>{input}</div>',
];

$fieldOptions2 = [
    'errorOptions' => [
        'class' => 'invalid-feedback',
        'style' => ['display' => 'block']
    ],
    'template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-user" style="color: black;"></i></span>{input}</div>',
];


$fieldOptions3 = [
    'errorOptions' => [
        'class' => 'invalid-feedback',
        'style' => ['display' => 'block']
    ],
    'template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope-o" style="color: black;"></i></span>{input}</div>',
];

$fieldOptions4 = [
    'errorOptions' => [
        'class' => 'invalid-feedback',
        'style' => ['display' => 'block']
    ],
    'template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-key" style="color: black;"></i></span>{input}</div>',
];

$fieldOptions5 = [
    'errorOptions' => [
        'class' => 'invalid-feedback',
        'style' => ['display' => 'block']
    ],
    'template' => '<div class="input-group"><span class="input-group-addon"><i class="fa fa-key" style="color: black;"></i></span>{input}</div>',
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

                            <?= $form->field($model, 'first_name', $fieldOptions1)->textInput([
                                'autofocus' => true,
                                'type' => 'text',
                                'id' => 'first_name',
                                'class' => 'form-control',
                                'placeholder' => Yii::t('app', 'Nombre(s)')
                            ])->label(false) ?>

                            <?= $form->field($model, 'last_name', $fieldOptions2)->textInput([
                                'autofocus' => true,
                                'type' => 'text',
                                'id' => 'last_name',
                                'class' => 'form-control',
                                'placeholder' => Yii::t('app', 'Apellidos')
                            ])->label(false) ?>

                            <?= $form->field($model, 'email', $fieldOptions3)->textInput([
                                'type' => 'email',
                                'id' => 'email',
                                'class' => 'form-control',
                                'placeholder' => Yii::t('app', 'Correo electrónico')
                            ])->label(false) ?>

                            <?= $form->field($model, 'password', $fieldOptions4)->passwordInput([
                                'id' => 'password',
                                'class' => 'form-control',
                                'placeholder' => Yii::t('app', 'Contraseña')
                            ])->label(false) ?>

                            <?= $form->field($model, 'password_confirm', $fieldOptions5)->passwordInput([
                                'id' => 'password2',
                                'class' => 'form-control',
                                'placeholder' => Yii::t('app', 'Confirmar contraseña')
                            ])->label(false) ?>

                            <div id="pass-info" class="clearfix"></div>
                            
                            <div class="row">
                                <?= Html::submitButton(
                                    Yii::t('app', 'Registrarme'), [
                                        'style' => 'font-size: 10px',
                                        'class' => 'btn btn-outline-danger btn-block'
                                    ]
                                ) ?>
                            </div>

                            <div class="text-center add_top_10">
                                <?= Yii::t('app', '¿Ya está registrado?') ?>
                                <strong>
                                    <?= Html::a(Yii::t('app', 'Inicie sesión'), ['/site/login'], [
                                        'class' => 'btn btn-primary btn-sm',
                                        'style' => 'font-size: 10px;'
                                    ]) ?>
                                </strong>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>