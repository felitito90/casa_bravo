<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\BurgerAsset;
use yii\helpers\Html;
use app\widgets\toast\ToastrFlashMessage;
use yii\helpers\Url;

$bundle = BurgerAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render('_header.php') ?>

<div class="wrap">
    <?= $content ?>
</div>

<?= $this->render('_footer') ?>

<?php $this->endBody() ?>
<?php
foreach (Yii::$app->session->getAllFlashes() as $message) {
    echo ToastrFlashMessage::widget([
        'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
        'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
        'message' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
        'options' => [
            "closeButton" => true,
            "newestOnTop" => true,
            "progressBar" => false,
            "positionClass" => ToastrFlashMessage::POSITION_TOP_RIGHT,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "5000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "closeEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut",
            "closeMethod" => "slideUp"
        ]
    ]);
}
?>
</body>
</html>
<?php $this->endPage() ?>
