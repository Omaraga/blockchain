<?php

namespace backend\controllers;

use common\models\Task;
use backend\models\TaskSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Module;
use Yii;
use common\models\ModuleTask;

/**
 * ConstructorController implements the CRUD actions for Task model.
 */
class ConstructorController extends Controller
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
     * Lists all Task models.
     *
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        $module = Yii::$app->request->get('moduleId') ? Module::findOne(Yii::$app->request->get('moduleId')) : null;
        if (!$module){
            return $this->redirect('/module');
        }

        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'module' => $module,
        ]);
    }



    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $module = Yii::$app->request->get('moduleId') ? Module::findOne(Yii::$app->request->get('moduleId')) : null;
        $task = Yii::$app->request->get('taskId') ? Task::findOne(Yii::$app->request->get('taskId')) : null;
        if (!$task || !$module){
            return $this->redirect('/module');
        }
        $moduleTask = ModuleTask::find()->where(['target_id' => $module->id, 'related_id' => $task->id])->one();
        if ($moduleTask){
            return $this->redirect(['/constructor/index', 'moduleId' => $module->id]);
        }

        $model = new ModuleTask();
        $model->loadDefaultValues();
        $model->target_id = $module->id;
        $model->related_id = $task->id;
        $model->save();
        return $this->redirect(['/constructor/index', 'moduleId' => $module->id]);

    }



    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $moduleId, $url = 'index')
    {
        $this->findModel($id)->delete();

        return $this->redirect([$url, 'moduleId' => $moduleId]);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ModuleTask the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ModuleTask::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
