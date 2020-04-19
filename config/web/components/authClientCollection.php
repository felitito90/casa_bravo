<?php
use SideKit\Config\ConfigKit;

return [
    'class' => 'yii\authclient\Collection',
    'clients' => [
        'facebook' => [
            'class' => 'yii\authclient\clients\Facebook',
            'clientId' => ConfigKit::env()->get('FACEBOOK_CLIENT_ID'),
            'clientSecret' => ConfigKit::env()->get('FACEBOOK_CLIENT_SECRET'),
        ],
    ],
];