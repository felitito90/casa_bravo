<?php

$params = include __DIR__ . '/params.php';
$db = include __DIR__ . '/web-local.php';

$config = [
    'id' => 'practical-b-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager'  => [
            'class' => 'yii\rbac\DbManager',
        ],
        'db' => $db['components']['db'],
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => [
                '@app/migrations',
                '@yii/rbac/migrations', // Just in case you forgot to run it on console (see next note)
            ],
            'migrationNamespaces' => [
                'Da\User\Migration',
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            'classMap' => [
                'User' => app\models\User::class,
            ],
            'administrators' => ['SuperAdmin'],
            // 'generatePasswords' => true,
            // 'switchIdentitySessionKey' => 'myown_usuario_admin_user_key',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
