<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl([
    'site/reset-password',
    'token' => $user->security_token
]);

if (preg_match('/dashboard/', $resetLink)) {
    $resetLink = preg_replace('/dashboard/', 'dashboard', $resetLink);
}

?>
Hola <?= $user->customer->first_name ?>,

Siga el siguiente enlace para restablecer su contraseña:

<?= $resetLink ?>
