<?php

return [

    /*
     * --------------------------------------------------------------------------
     * Dos Amigos User Module
     * --------------------------------------------------------------------------
     *
     * Implements User Management Module configuration
     */

    'class' => 'Da\User\Module',
    'enableRegistration' => false,
    'administrators' => ['SuperAdmin'],
    'controllerMap' => [
        'security' => [
            'class' => 'Da\User\Controller\SecurityController',
        ],
        'recovery' => [
            'class' => 'Da\User\Controller\RecoveryController',
        ],
        'registration' => [
            'class' => 'Da\User\Controller\RegistrationController',
        ],
        'admin' => [
            'class' => 'Da\User\Controller\AdminController',
        ],
        'role' => [
            'class' => 'Da\User\Controller\RoleController',
        ],
        'permission' => [
            'class' => 'Da\User\Controller\PermissionController',
        ],
        'rule' => [
            'class' => 'Da\User\Controller\RuleController',
        ]
    ],
];
