<?php
/* @var $this yii\web\View */

use kartik\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Menú');
?>
<!-- header-end -->

<!-- bradcam_area_start -->
<div class="bradcam_area breadcam_bg overlay" style="background: url('<?= Yii::getAlias('@web') ?>/img/menu-items-banner.jpg'); no-repeat center center; background-size: cover;">
    <h3><?= Yii::t('app', 'Menú') ?></h3>
</div>
<!-- best_burgers_area_start  -->
<div class="area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section_title text-center mb-80">
                    <span>Platos fuertes</span>
                    <h3>Los mejores platillos</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($menuItems as $menuItem) { ?>
                <div class="col-xs-6 col-md-6 col-sm-6">
                    <div class="single_delicious d-flex align-items-center">
                        <div class="card">
                            <img class="card-img" src="<?= Yii::getAlias('@domainName/img/menu_items/') . $menuItem->item_photo ?>" alt="<?= $menuItem->item_name ?>">
                            <div class="card-body">
                                <h4 class="card-title"><?= Html::a(Html::encode($menuItem->item_name), Url::to(['/menu-items/view', 'id' => $menuItem->id])) ?></h4>
                                <h6 class="card-subtitle mb-2 text-muted"><?= $menuItem->getType() ?></h6>
                                <p class="card-text"><?= Html::encode($menuItem->description) ?></p>
                                <div class="options d-flex flex-fill">
                                    <div class="row">
                                        <div class="qtyButtons">
                                            <div class="qtyDec"></div>
                                            <div class="qtyTotal" style="display:none;"></div>
                                            <input type="text" class="input-request-number" data-qty_name="qtyInput" id='item-<?= $menuItem->id ?>' name='item_<?= $menuItem->id ?>' value="0" min="0">
                                            <div class="qtyInc"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="buy d-flex justify-content-between align-items-center">
                                    <div class="price text-success">
                                        <h5 class="mt-4">$<?= number_format(Html::encode($menuItem->price), 2, '.', ',') ?> (c/u)</h5>
                                    </div>
                                    <a href="javascript:void(0);" data-item="<?= $menuItem->id ?>" class="btn btn-outline-danger mt-3 buyItem"><i class="fa fa-shopping-cart"></i> Añadir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- best_burgers_area_end  -->
<?php $this->registerJs('
    $(document).ready(function () {
        if ($(".input-request-number").length > 0) {
            function qtySum() {
                var arr = document.querySelector("[data-qty_name]");
                var tot = 0;
                for (var i = 0; i < arr.length; i++) {
                    if (parseInt(arr[i].value))
                        tot += parseInt(arr[i].value);
                }

                var cardQty = document.querySelector(".qtyTotal");
                cardQty.innerHTML = tot;
            }
            qtySum();

            // $(".qtyButtons input").after(`<div class="qtyInc"></div>`);
            // $(".qtyButtons input").before(`<div class="qtyDec"></div>`);
            $(".qtyDec, .qtyInc").on("click", function () {
                var $button = $(this);
                var oldValue = $button.parent().find("input").val();

                if ($button.hasClass("qtyInc")) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // dont allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }

                $button.parent().find("input").val(newVal);
                qtySum();
                $(".qtyTotal").addClass("rotate-x");
            });

            function removeAnimation() { $(".qtyTotal").removeClass("rotate-x"); }
            const counter = document.querySelector(".qtyTotal");
            counter.addEventListener("animationend", removeAnimation);
        }

        $(".buyItem").click(function() {
            let menuItemId = $(this).data("item");
            let quantity = document.querySelector(`#item-${menuItemId}`).value;
            let orderUrl = "' . Url::to(['/menu-items/order']) . '";

            // Header badge
            if (quantity != 0) {
                let ordersQuantity = $("[data-orderItems]:last");
                let actualOrdersQuantity = parseInt(ordersQuantity.text()) + 1;
                ordersQuantity.text(actualOrdersQuantity);
            }

            fetch(`${orderUrl}?menuItem=${menuItemId}&quantity=${quantity}`)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    console.log(data);
                    toastr.success(`
                        Añadiendo ${quantity} a la lista de órdenes... <br>
                        Para realizar su pedido puede pasar al menú "Productos ordenados"
                    `);
                });
        });
    });
');
