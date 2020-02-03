<?php
// events.php file

use Da\User\Controller\RecoveryController;
use Da\User\Controller\RegistrationController;
use Da\User\Event\FormEvent;
use Da\User\Event\ResetPasswordEvent;
use yii\base\Event;

Event::on(
    RecoveryController::class, FormEvent::EVENT_AFTER_REQUEST, function (FormEvent $event) {
        \Yii::$app->controller->redirect(['/user/login']);
        \Yii::$app->end();
    }
);

Event::on(
    RecoveryController::class, ResetPasswordEvent::EVENT_AFTER_RESET, function (ResetPasswordEvent $event) {
        if ($event->token->user ?? false) {
            \Yii::$app->user->login($event->token->user);
        }
        \Yii::$app->controller->redirect(\Yii::$app->getUser()->getReturnUrl());
        \Yii::$app->end();
    }
);

Event::on(
    RegistrationController::class, FormEvent::EVENT_AFTER_RESEND, function (FormEvent $event) {
        \Yii::$app->controller->redirect(['/user/login']);
        \Yii::$app->end();
    }
);
