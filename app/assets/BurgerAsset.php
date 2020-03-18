<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Andrey Poot May <andreypootmay@gmail.com>
 */
class BurgerAsset extends AssetBundle
{
    public $sourcePath = '@app/template/burger/';
    public $css = [
        // base css
        'css/bootstrap.min.css',
        'css/owl.carousel.min.css',
        'css/magnific-popup.css',
        'css/themify-icons.css',
        'css/font-awesome.min.css',
        'css/nice-select.css',
        'css/flaticon.css',
        'css/animate.css',
        'css/slicknav.css',
        'css/style.css',
    ];

    public $js = [
        'js/vendor/jquery-1.12.4.min.js',
        'js/vendor/modernizr-3.5.0.min.js',
        'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/owl.carousel.min.js',
        'js/isotope.pkgd.min.js',
        'js/ajax-form.js',
        'js/waypoints.min.js',
        'js/jquery.counterup.min.js',
        'js/imagesloaded.pkgd.min.js',
        'js/scrollIt.js',
        'js/jquery.scrollUp.min.js',
        'js/wow.min.js',
        'js/nice-select.min.js',
        'js/jquery.slicknav.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/plugins.js',
        'js/contact.js',
        'js/jquery.ajaxchimp.min.js',
        'js/jquery.form.js',
        'js/jquery.validate.min.js',
        'js/mail-script.js',
        'js/main.js',
    ];

    public $depends = [];

    /**
     * @param string $asset
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    static public function getAssetUrl($asset)
    {
        return \Yii::$app->assetManager->getAssetUrl(\Yii::$app->assetManager->getBundle(static::class), $asset);
    }
}
