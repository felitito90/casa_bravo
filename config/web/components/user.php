<?php

return [

    /*
     * --------------------------------------------------------------------------
     * User Component
     * --------------------------------------------------------------------------
     *
     * Implements User Identity configuration
     */
    'identityClass' => 'app\models\CustomersAuth',
    'enableAutoLogin' => true,
    'enableSession' => true,
    'authTimeout' => 86400, // Automatic logout in 24 hrs
];
