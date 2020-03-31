<?php

use kartik\helpers\Html;
use yii\helpers\Url;
use app\models\helpers\ValueHelpers;

$orderedProducts = ValueHelpers::getOrderedProductsQuantity();
?>
<!-- header-start -->
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid p-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-xl-5 col-lg-5">
                        <div class="main-menu  d-none d-lg-block">
                            <nav>
                                <ul id="navigation">
                                    <li><a class="active" href="<?= Url::to(['/site/index']) ?>">Inicio</a></li>
                                    <li><a href="<?= Url::to(['/menu-items/index']) ?>">Menú</a></li>
                                    <li><a href="<?= Url::to(['/sale-items/index']) ?>">Productos ordenados <span class="badge badge-products" data-orderItems="orders"><?= $orderedProducts ?></span></a></li>
                                    <?php if (!Yii::$app->user->isGuest) { ?>
                                        <li>
                                            <?= Html::a('Salir', Url::to(['/site/logout']), [
                                                'data-method' => 'post',
                                                'title' => Yii::t('app', 'Salir')
                                            ]) ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo-img">
                            <a href="index.html">
                                <img src="img/casa-bravo.png" alt="" width="184" height="100">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 d-none d-lg-block">
                        <div class="book_room">
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="https://www.instagram.com/casabravomx">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/casabravomx">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="book_btn d-none d-xl-block">
                                <a class="#" href="#">442 241 9813</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>