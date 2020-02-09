<?php

use \kartik\datecontrol\Module;
use \kartik\mpdf\Pdf;

$params = include __DIR__ . '/params.php';

$config = [
    'id' => 'casa_bravo',
    'name' => 'Casa Bravo',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@logos' => '../images/logos',
        //'@imgDocs' => '../images/doctors',
        //'@docsUsg' => '../documents/usg',
        //'@docsLabs' => '../documents/labs',
        '@imgMenu' => '../images/menu-items',
        //'@docsGstaff' => '../documents/generalstaff'
    ],
    'language' => 'es-MX',
    'sourceLanguage' => 'es-MX',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'PEi6ICsok3vWiJSJJtQV2JZ6D-jk5gkh',
        ],
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_LETTER,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            //'cssInline' => 'p { color: blue; }',
            'options' => ['title' => Yii::t('app', 'Reporte')],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@Da/User/resources/views' => '@app/views/user'
                ],
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'authManager'  => [
            'class' => 'Da\User\Component\AuthDbManagerComponent',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            'classMap' => [
                'User' => app\models\User::class,
            ],
            'controllerMap' => [
                'security' => [
                    'class' => 'Da\User\Controller\SecurityController',
                    'layout' => '//login'
                ],
                'recovery' => [
                    'class' => 'Da\User\Controller\RecoveryController',
                    'layout' => '//login'
                ],
                'registration' => [
                    'class' => 'Da\User\Controller\RegistrationController',
                    'layout' => '//login'
                ],
                'admin' => [
                    'class' => 'Da\User\Controller\AdminController',
                    'layout' => '//settings'
                ]
            ],
            'administrators' => ['SuperAdmin'],
            'enableRegistration' => false,
            // 'generatePasswords' => true,
            // 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
            'mailParams' => [
                'fromEmail' => 'no-reply@example.com',
            ],
        ],
        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd/MM/yyyy',
                Module::FORMAT_TIME => 'hh:mm:ss a',
                Module::FORMAT_DATETIME => 'dd/MM/yyyy hh:mm:ss a',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],

            // set your display timezone
            //'displayTimezone' => 'America/New_York',

            // set your timezone for date saved to db
            //'saveTimezone' => 'UTC',

            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type' => 2, 'pluginOptions' => ['autoclose' => true]],
                Module::FORMAT_DATETIME => [],
                Module::FORMAT_TIME => [],
            ],
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/messages',
                'forceTranslation' => true
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        //uncomment the following to add your IP if you are not connecting from localhost.
        //allowedIPs' => ['127.0.0.1', '::1'],
        'class' => 'yii\debug\Module',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}
return $config;
