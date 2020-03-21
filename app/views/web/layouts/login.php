<?php

use app\assets\BurgerAsset;
use yii\helpers\Html;

BurgerAsset::register($this);

$this->title = Yii::t('app', 'Ingresar');
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
<?php $this->registerCss('body{background-color: black;}') ?>
<?php $this->beginBody()  ?>
<div class="login-page full">
    <div id="login-full-wrapper" style="background: url('<?= Yii::getAlias('@web') ?>/img/samples/login-img.jpg'); no-repeat center center; background-size: cover;width: 100%;height: 100%;position: absolute;">
        <div class="container">
            <?php
            foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
            }
            ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>