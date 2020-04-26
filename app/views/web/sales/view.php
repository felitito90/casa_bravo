<?php

use kartik\grid\GridView;

$this->title = Yii::t('app', 'Orden') . ' ' . $model->order_folio;

?>
<div class="bradcam_area breadcam_bg overlay" style="background: url('<?= Yii::getAlias('@web') ?>/img/menu-items-banner.jpg'); no-repeat center center; background-size: cover;">
    <h3><?= $this->title ?></h3>
</div>