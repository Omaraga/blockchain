<?php

namespace backend\controllers;

use backend\models\TicketSearchForm;
use common\models\Messages;
use common\models\Tickets;
use backend\models\SearchTickets;
use common\models\User;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use Yii;
/**
 * TicketsController implements the CRUD actions for Tickets model.
 */
class TicketsController extends Controller
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
     * Lists all Tickets models.
     *
     * @return string
     */
    public function actionIndex($tab = 1)
    {
        $allTickets = Tickets::find()->all();
        $searchModel = new TicketSearchForm();
        $userNameCondition = [];
        $dateStartCondition = [];
        $dateEndCondition = [];
        $idCondition = [];
        $users = ArrayHelper::getColumn(User::find()->select('username')->asArray()->all(),'username');
        if ($searchModel->load(\Yii::$app->request->post())){
            if (strlen($searchModel->username) > 0){
                $searchUser = User::find()->select('id')->where(['username'=>$searchModel->username])->asArray()->one();
                if (!is_null($searchUser)){
                    $userNameCondition = ['user_id'=>$searchUser['id']];
                }
            }
            if(strlen($searchModel->id) > 0){
                $searchTicket = Tickets::find()->where(['id'=>$searchModel->id])->asArray()->one();
                if (!is_null($searchTicket)){
                    $idCondition = ['id'=>$searchTicket['id']];
                }
            }
            if (isset($searchModel->date_start) && strlen($searchModel->date_start) > 0){
                $searchModel->setTimes();
                $dateStartCondition = ['>=', 'time', $searchModel->time_start];
            }
            if (isset($searchModel->date_end) && strlen($searchModel->date_end) > 0){
                $searchModel->setTimes();
                $dateEndCondition = ['<=', 'time', $searchModel->time_end];
            }
        }
        if($tab == 1){
            $dataProvider = new ActiveDataProvider([
                'query' => Tickets::find()->where(['status'=>3])->andWhere($userNameCondition)->andWhere($idCondition)->andWhere($dateStartCondition)->andWhere($dateEndCondition)->orderBy('id desc'),
            ]);
        }elseif ($tab==2){
            $dataProvider = new ActiveDataProvider([
                'query' => Tickets::find()->where(['status'=>2])->andWhere($userNameCondition)->andWhere($idCondition)->andWhere($dateStartCondition)->andWhere($dateEndCondition)->orderBy('id desc'),
            ]);
        }elseif ($tab==3){
            $dataProvider = new ActiveDataProvider([
                'query' => Tickets::find()->where(['status'=>1])->andWhere($userNameCondition)->andWhere($idCondition)->andWhere($dateStartCondition)->andWhere($dateEndCondition)->orderBy('id desc'),
            ]);
        }else{
            $dataProvider = new ActiveDataProvider([
                'query' => Tickets::find()->orderBy('id desc'),
            ]);
        }



        return $this->render('index', [
            'searchModel'=>$searchModel,
            'users'=>$users,
            'dataProvider'=>$dataProvider,
            'tab'=>$tab,
        ]);
    }

    /**
     * Displays a single Tickets model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $messageForm = new \frontend\models\forms\MessageForm();
        if ($messageForm->load(\Yii::$app->request->post()) && $messageForm->validate()) {
            $ticket = Tickets::findOne($id);
            $ticket->status = 2;
            if (!isset($ticket->end_time) || $ticket->end_time == null){
                $ticket->end_time = strtotime ('3 weekdays')+60*60*12;
            }
            $ticket->save();

            $message = new Messages();
            $message->time = time();
            $message->user_id = 1;
            $message->ticket_id = $ticket['id'];
            $message->text = $messageForm->text;

            $file = UploadedFile::getInstance($messageForm, 'file');
            $link = null;
            if ($file && $file->tempName) {
                $messageForm->file = $file;
                if ($messageForm->validate(['file'])) {

                    $rand = rand(900000,9000000);
                    $dir = Yii::getAlias('@frontend/web/docs/tickets/');
                    $dir2 = Yii::getAlias('docs/tickets/');
                    $fileName = $rand . '.' . $messageForm->file->extension;
                    $messageForm->file->saveAs($dir . $fileName);
                    $messageForm->file = $fileName; // без этого ошибка
                    $link = '/'.$dir2 . $fileName;
                }
            }
            $message->link = $link;

            if($message->save()){
                Yii::$app->getSession()->setFlash('success', Yii::t('users', 'Сообщение отправлено!'));
            }else{
                Yii::$app->getSession()->setFlash('danger', Yii::t('users', 'Произошла ошибка, попробуйте повторить!'));
            }

        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'messageForm' => $messageForm,
        ]);
    }

    /**
     * Creates a new Tickets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tickets();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tickets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tickets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tickets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tickets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tickets::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionUpdateMessage()
    {
        if (Yii::$app->request->isPost){
            $ticketId = Yii::$app->request->post('ticketId');
            $message = Yii::$app->request->post('message');
            $userId = Yii::$app->request->post('from');
            $devStatus = Yii::$app->request->post('status');
            $ticket = Tickets::findOne($ticketId);
            $user = User::findOne($userId);

            if (isset($ticket) && isset($user) && isset($message)){
                if ($devStatus == 'toWork') {
                    $ticket->status = 1;
                    $notification = 'Разработчик: Заявка  №'.$ticket['id'].' принято в работу. Тема:'.$ticket['title'];
                    $res = $this->sendTelegramNotification($notification, 'Logicmath');
                }else if ($devStatus == 'toCheck'){
                    $ticket->status = 2;
                    $notification = 'Разработчик: Заявка  №'.$ticket['id'].' отправлено на проверку администратору.Просим проверить.';
                    $res = $this->sendTelegramNotification($notification, 'Logicmath');
                }else if($devStatus == 'toClose'){
                    $ticket->status = 3;
                    $notification = 'Администратор: Заявка  №'.$ticket['id'].' закрыто.';
                    $res = $this->sendTelegramNotification($notification, 'Logicmath');
                }


                if (!$ticket->save()){
                    return json_encode(['status'=>'error', 'error'=>'Ошибка сервера ticket']);
                }
                $messageModel = new Messages();
                $messageModel->time = time();
                $messageModel->user_id = $user['id'];
                $messageModel->ticket_id = $ticket['id'];
                $messageModel->text = $message;
                $messageModel->is_private = 1;
                if(!$messageModel->save()){
                    return json_encode(['status'=>'error', 'error'=>'Ошибка сервера message']);
                }
                return json_encode(['status'=>'success', 'error'=>'', 'userRole'=>'admin']);
            }else{
                return json_encode(['status'=>'error', 'error'=>'Ошибка в запросе']);
            }
        }

    }
    public function actionPrint($object){
        print_r($object);

    }
    public function actionClose(){
        $tickets = Tickets::find()->where(['<' , 'time', 1622377655])->andWhere(['status'=>2])->all();
        foreach ($tickets as $ticket){
            $ticket->status = 1;
            $ticket->save(false);
            echo date('d.m.y', $ticket->time).'<hr>';
        }
        die;
    }
    private function sendTelegramNotification($notification, $localPass = null)
    {
        //https://api.telegram.org/bot5272221672:AAGGUyfbNlxCk354CuBmwuaNCRZn9bOdEEY/getUpdates - узнать id чата
        if ($localPass == 'Logicmath'){
            $token = "5272221672:AAGGUyfbNlxCk354CuBmwuaNCRZn9bOdEEY";
            $chat_id = "-765956848";
            $txt = $notification;
            $url = "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}";
            try {
                $sendTelegram = fopen($url, "r");
                if (!$sendTelegram){
                    throw new Exception('Error');
                }
            }catch (\Exception $exception){
                return false;
            }
        }else{
            return false;
        }



    }
}
