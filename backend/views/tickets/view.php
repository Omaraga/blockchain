<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
/* @var $this yii\web\View */
/* @var $model common\models\Tickets */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$messages = \common\models\Messages::find()->where(['ticket_id'=>$model->id])->all();
$user = \common\models\User::findOne($model['user_id']);
$currUser = \common\models\User::findOne(Yii::$app->user->identity['id']);

$dir = Yii::getAlias('@frontend/web');

?>
<div class="tickets-view">

    <p>
        <?= Html::a('Изменить статус', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Категория',
                'value' => function($data){
                    return \common\models\Tickets::getCategoryList()[$data['category']];
                }
            ],
            [
                'label' => 'Тапсырма',
                'value' => function($data){
                    if ($data['task_id']){
                        $task = \common\models\Task::findOne($data['task_id']);
                        return Html::a('Тапсыма №'.$task['id'], '/task/view?id='.$data['task_id']);
                    }
                },
                'format' => 'raw',
            ],

            'title',
            [
                'label'=>'Пользователь',
                'value'=>function($data){
                    $user = \common\models\User::findOne($data['user_id']);
                    return Html::a($user['username'],'/users/view?id='.$data['user_id']);
                },
                'format' => 'raw'
            ],
            [
                'label'=>'Дата',
                'value'=>function($data){
                    return date("d.m.Y H:i",$data['time']);
                },
            ],
            [
                'label'=>'Статус',
                'value'=>function($data){
                    if($data['status']==3){
                        return "В обработке";
                    }elseif($data['status']==2){
                        return "Отвечен";
                    }elseif($data['status']==1){
                        return "Закрыт";
                    }
                },
            ],
        ],
    ]) ?>

    <h3>Сообщения</h3>

    <?
    foreach ($messages as $message) {?>
        <div class="card mt-4 mb-5">
            <div class="card-header" <?if($message['user_id'] == 1){?>style="background-color: #d2ecff;" <?}?>>
                <span><?if($message['user_id'] == 1){echo "Администратор";}else{echo $user['fio'];}?></span>
                <span style="float: right;"><?=date('d.m.Y H:i',$message['time'])?></span>
            </div>
            <div class="card-body">
                <p class="card-text"><?=$message['text']?></p>
                <?if(!empty($message['link'])){?>
                    <a target="_blank" href="<?=Yii::$app->params['url'];?><?=$message['link']?>" class="btn btn-link">Скачать файл</a>
                <?}?>

            </div>
        </div>
    <?}?>

    <div class="card mt-6">
        <div class="card-header">
            Написать сообщение
        </div>
        <div class="card-body">
            <?php $form = \yii\widgets\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($messageForm, 'text')->textarea(['rows'=>6]); ?>
            <?= $form->field($messageForm, 'file')->fileInput(['class'=>'form-control-file btn btn-link pl-0']);  ?>
            <input class="btn-success btn" type="submit" value="<?=Yii::t('users', 'SEND')?>">
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>
