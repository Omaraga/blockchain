<?php

namespace frontend\controllers;

use common\models\Request;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MyRequestController implements the CRUD actions for Request model.
 */
class MyRequestController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Request models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Request::find()->where(['user_id' => \Yii::$app->user->identity->getId()]),

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAuthor()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Request::find()->where(['author_id' => \Yii::$app->user->identity->getId()]),

        ]);

        return $this->render('author', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAccept(){
        $request = Request::findOne((int)\Yii::$app->request->get('id'));
        $request->status = Request::STATUS_ACCEPT;
        $request->code = uniqid(rand(), true);
        $request->save();
        return $this->redirect('/my-request/index');
    }
    public function actionDecline(){
        $request = Request::findOne((int)\Yii::$app->request->get('id'));
        $request->status = Request::STATUS_ACCEPT;
        $request->save();
        return $this->redirect('/my-request/author');
    }






    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
