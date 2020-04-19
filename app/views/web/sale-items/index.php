<?php
/* @var $this yii\web\View */

use app\models\helpers\ValueHelpers;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Orden de compra');
?>
<div class="sale-items-index">
    <!-- bradcam_area_start -->
    <div class="bradcam_area breadcam_bg overlay" style="background: url('<?= Yii::getAlias('@web') ?>/img/sale-items-banner.jpg'); no-repeat center center; background-size: cover;">
        <h3><?= $this->title ?></h3>
    </div>
    <!-- bradcam_area_end -->

    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"> </th>
                                <th scope="col">Producto</th>
                                <th scope="col">Tipo</th>
                                <th scope="col" class="text-center">Cantidad</th>
                                <th scope="col" class="text-right">Precio (c/u)</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($saleItems as $saleItem) { ?>
                                <tr id="item-<?= $saleItem->id ?>">
                                    <td><img src="<?= $saleItem->menuItem->itemPhoto ?>" width="50" height="50"/> </td>
                                    <td><?= $saleItem->menuItem->item_name ?></td>
                                    <td><?= $saleItem->menuItem->getType() ?></td>
                                    <td><input class="form-control" type="text" data-saleItemIdInput="<?= $saleItem->id ?>" value="<?= $saleItem->quantity ?>" /></td>
                                    <td class="text-right">$ <?= number_format(Html::encode($saleItem->menuItem->price), 2, '.', ',') ?></td>
                                    <td class="text-right">
                                        <button class="btn btn-sm btn-primary save" data-toggle="tooltip" data-placement="top" data-saleitemid="btn-<?= $saleItem->id ?>" title="Guardar"><i class="fa fa-floppy-o"></i> </button>
                                        <button class="btn btn-sm btn-danger delete" data-saleitemid="btn-<?= $saleItem->id ?>"><i class="fa fa-trash"></i> </button>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Sub-Total</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td class="text-right"><strong class="grand-total">$ <?= number_format(ValueHelpers::getOrderedProductsTotal(), 2, '.', ',') ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6 text-right">
                        <?= Html::a('<i class="fa fa-arrow-left"></i> ' . Yii::t('app', 'Seguir comprando'), ['/menu-items/index'], [
                            'class' => 'btn btn-lg btn-block btn-dark text-uppercase'
                        ]) ?>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <?= Html::a('<i class="fa fa-money"></i> ' . Yii::t('app', 'Ordenar'), ['/sale-items/create'], [
                            'class' => 'btn btn-lg btn-block btn-success text-uppercase'
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->registerJs('
    $(document).ready(function () {
        $(".save").click(function () {
            let saleItemId = $(this).data("saleitemid").split("-")[1];
            let newQuantity = $(`[data-saleItemIdInput=${saleItemId}]`).val();
            
            let url = `' . Url::to(["/sale-items/update-quantity"]) . '?id=${saleItemId}&quantity=${newQuantity}`;
            console.log(url);
            fetch(url)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    toastr.success(data.success);
                    $(`[data-saleItemIdInput=${saleItemId}]`).attr("disabled", true);
                    $(".grand-total").text(data.total);
                })
                .catch(err => {
                    toastr.error(err);
                });
        });

        $(".delete").click(function() {
            let saleItemId = $(this).data("saleitemid").split("-")[1];
            let url = `' . Url::to(['/sale-items/delete']) . '?id=${saleItemId}`;

            let sure = confirm ("¿Está seguro de eliminar el platillo de la orden?");
            if (sure) {
                // Elimino de la db y elimino de la lista
                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        toastr.success(data.success);
                        console.log(data.total);
                        $(`#item-${saleItemId}`).remove();
                        $(".grand-total").text(data.total);
                    })
                    .catch(err => {
                        toastr.error(err);
                    });
            }
        });
    });
') ?>