<?php

namespace backend\controllers;

use backend\components\AccessRule;
use backend\models\LoginForm;
use backend\models\Profile;
use common\models\Settings;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\BaseAdminController as Controller;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => [
                            User::ROLE_DEFAULT_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN,
                            User::ROLE_SUPER_ADMIN,
                        ],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ]);
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = Settings::find()->one();
        if (!$model){
            $model = new Settings();
        }
        $model->loadDefaultValues(false);
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpdateSettings(){
        $model = Settings::find()->one();
        if (!$model){
            $model = new Settings();
        }
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->save()){
                    Yii::$app->session->setFlash('success', 'Изменения сохранены');
                }else{
                    Yii::$app->session->setFlash('error', 'Ошибка прим сохранении');
                }
                return $this->goHome();

            }
        }
        $model->loadDefaultValues(false);
        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'Вы успешно авторизовались');
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionProfile(){
        $model = Profile::findOne(Yii::$app->user->identity->getId());
        if ($model->load(Yii::$app->request->post())){
            if ($model->save()){
                if ($model->save()){
                    Yii::$app->session->setFlash('success', 'Изменения сохранены');
                }else{
                    Yii::$app->session->setFlash('error', 'Ошибка прим сохранении');
                }
                return $this->goHome();
            }
        }
        return $this->render('profile', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
