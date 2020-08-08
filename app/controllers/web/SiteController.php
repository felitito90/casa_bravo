<?php

namespace app\controllers\web;

use app\models\CustomersAuth;
use app\models\forms\web\ConfirmEmailRequestWebForm;
use app\models\forms\web\LoginWebForm;
use app\models\forms\web\PasswordResetRequestWebForm;
use app\models\forms\web\ResetPasswordWebForm;
use app\models\forms\web\SignupWebForm;
use SideKit\Config\ConfigKit;
use app\components\AuthHandler;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class SiteController extends Controller
{
    public $layout;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!(Yii::$app->user->isGuest)) {
            return $this->render('index');
        } else {
            $this->layout = 'login';
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Login action.
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginWebForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Signs user up.
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'login';

        $model = new SignupWebForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if ($model->sendEmail($user)) {
                    Yii::$app->session->setFlash(
                        'success',
                        Yii::t('app', 'En un momento te llegará el enlace de confirmación a tu correo electrónico. No olvides revisar tu bandeja de correo no deseado o spam.')
                    );
                    return $this->redirect(['login']);
                } else {
                    Yii::$app->session->setFlash(
                        'danger',
                        Yii::t('app', 'Lo sentimos, no podemos confirmar su correo, intente más tarde.')
                    );
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Resend user up confirm
     * @return mixed
     */
    public function actionRequestConfirmEmail()
    {
        $this->layout = 'login';

        $model = new ConfirmEmailRequestWebForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash(
                    'success',
                    Yii::t('app', 'Revise su correo electrónico para obtener más instrucciones.')
                );
                return $this->redirect(['login']);
            } else {
                Yii::$app->session->setFlash(
                    'danger',
                    Yii::t('app', 'Lo sentimos, no podemos restablecer la contraseña para el correo electrónico proporcionado.')
                );
            }
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }

    /**
     * Confirm email.
     * @param string $token
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function actionConfirmEmail($token)
    {
        if (empty($token) || !is_string($token)) {
            throw new \InvalidArgumentException(Yii::t('app', 'El token para confirmar correo no debe estar en blanco.'));
        }

        $user = CustomersAuth::findBySecurityToken($token);

        if (!$user) {
            return $this->goHome();
        }

        $user->confirmed_at = time();
        $user->removeSecurityToken();

        if ($user->save(false)) {
            $user->updateAttributes([
                'last_login_at' => time(),
                'last_login_ip' => Yii::$app->request->getUserIP()
            ]);

            Yii::$app->session->setFlash('success', [
                'type' => 'success',
                'message' => Yii::t('app', 'Correo confirmado correctamente.'),
                'title' => Yii::t('app', 'Mensaje de casa_bravo'),
            ]);

            if (Yii::$app->user->login($user, 3600 * 24 * 30)) {
                return $this->goHome();
            }
        }

        return $this->redirect(['login']);
    }

    /**
     * Requests password reset.
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = 'login';

        $model = new PasswordResetRequestWebForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash(
                    'success',
                    Yii::t('app', 'Revise su correo electrónico para obtener más instrucciones.')
                );
                return $this->redirect(['login']);
            } else {
                Yii::$app->session->setFlash(
                    'danger',
                    Yii::t('app', 'Lo sentimos, no podemos restablecer la contraseña para el correo electrónico proporcionado.')
                );
            }
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }

    /**
     * [onAuthSuccess description]
     * @return  void
     */
    public function onAuthSuccess($client): void
    {
        (new AuthHandler($client))->handle();
    }

    /**
     * Resets password.
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordWebForm($token);
        } catch (\InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $this->layout = 'login';

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash(
                'success',
                Yii::t('app', 'Se ha guardado la nueva contraseña.')
            );

            return $this->redirect(['login']);
        }

        return $this->render('reset', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    /**
     * Displays about page.
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
