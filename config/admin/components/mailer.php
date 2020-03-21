<?php

use SideKit\Config\ConfigKit;

return [

    /*
     * --------------------------------------------------------------------------
     * Mailer
     * --------------------------------------------------------------------------
     *
     * Mailer implements a mailer based on SwiftMailer.
     */

    'class' => 'yii\swiftmailer\Mailer',

    /*
     * --------------------------------------------------------------------------
     * useFileTransport property
     * --------------------------------------------------------------------------
     *
     * Send all mails to a file by default. You have to set 'useFileTransport' to
     * false and configure a transport for the mailer to send real emails.
     */

    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => ConfigKit::env()->get('MAIL_HOST'),
        'username' => ConfigKit::env()->get('MAIL_USERNAME'),
        'password' => ConfigKit::env()->get('MAIL_PASSWORD'),
        'port' => ConfigKit::env()->get('MAIL_PORT'),
        'encryption' => ConfigKit::env()->get('MAIL_ENCRIPTION'),
    ],

    /*
     * --------------------------------------------------------------------------
     * viewPath property
     * --------------------------------------------------------------------------
     *
     * Configure the directory that contains the view files for composing emails.
     * Defaults to '@app/mail', let's place its views where it supposed to be.
     */

    'viewPath' => '@app/views/mail',
];
