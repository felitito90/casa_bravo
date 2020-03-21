<?php

use SideKit\Config\ConfigKit;

date_default_timezone_set('America/Cancun');

return [

    /*
     * --------------------------------------------------------------------------
     * Application
     * --------------------------------------------------------------------------
     *
     * Base class for all application classes. Here we configure the attributes
     * that do not hold any object configuration such as "components" or
     * "modules". The configuration of those properties are within submodules of
     * the same name.
     */

    'id' => 'casa-bravo-public',

    'name' => 'Casa Bravo',

    'basePath' => ConfigKit::config()->getBasePath(),

    'vendorPath' => ConfigKit::config()->getVendorPath(),

    'runtimePath' => ConfigKit::config()->getRuntimePath(),

    'language' => ConfigKit::env()->get('APP_LANGUAGE'),

    'bootstrap' => ['log'],

    'controllerNamespace' => 'app\controllers\web',
];
