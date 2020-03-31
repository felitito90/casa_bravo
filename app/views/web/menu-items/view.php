<?php
/* @var $this yii\web\View */

use kartik\helpers\Html;

$this->title = $model->item_name;

?>

<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay">
    <h3><?= $this->title ?></h3>
</div>
<!-- bradcam_area_end -->

<div class="single-product-wrapper">
    <div class="summary-product">
        <div class="row">
            <div class="col-md-6 col-xs-12 col-sm-12">
                <div class="card" style="width: 18rem;">
                    <img class="card-product-img" src="<?= Yii::getAlias('@domainName/img/menu_items/') . $model->item_photo ?>" class="card-img-top" alt="Imagen producto">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-12">

            </div>
        </div>
    </div>
</div>