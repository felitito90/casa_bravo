<?php

/* @var $this yii\web\View */

use app\models\helpers\ValueHelpers;

$this->title = Yii::t('app', 'Casa Bravo');
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Admin!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">Clientes registrados</div>
                    <div class="panel-body">
                        <h4 class="text-center"><?= ValueHelpers::getCustomersTotal() ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-danger">
                    <div class="panel-heading">Platillos</div>
                    <div class="panel-body">
                        <h4 class="text-center"><?= ValueHelpers::getFoodTotal() ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-success">
                    <div class="panel-heading">Bebidas</div>
                    <div class="panel-body">
                        <h4 class="text-center"><?= ValueHelpers::getDrinkTotal() ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">Ordenes realizadas</div>
                    <div class="panel-body">
                        <h4 class="text-center"><?= ValueHelpers::getSalesTotal() ?></h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>