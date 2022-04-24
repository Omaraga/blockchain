<?php
use yii\jui\DatePicker;
use kartik\typeahead\TypeaheadBasic;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Tickets;
/* @var $this yii\web\View */
/* @var $dataProviderWork yii\data\ActiveDataProvider */
/* @var $dataProviderAnswered yii\data\ActiveDataProvider */
/* @var $dataProviderEnd yii\data\ActiveDataProvider */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel backend\models\TicketSearchForm */
/* @var $users array */

$this->title = Yii::t('app', 'Tickets');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <? $form = \yii\widgets\ActiveForm::begin();?>
    <div class="col-md-4">

        <?=$form->field($searchModel, 'username')->widget(TypeaheadBasic::classname(), [
            'data' => $users,
            'options' => ['placeholder' => 'Логин', 'autocomplete'=>'off'],
            'pluginOptions' => ['highlight'=>true],
        ])->label('Логин');?>
    </div>
    <div class="col-md-4">

        <?= $form->field($searchModel, 'id')->textInput()->label('ID'); ?>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-3">
                <?=$form->field($searchModel, 'date_start')->widget(DatePicker::className(),[
                    'language' => 'ru',
                    'dateFormat' => 'dd.MM.yyyy',
                    'options'=>['autocomplete'=>'off'],
                ])->label('Дата с:');?>
            </div>
            <div class="col-md-3">
                <?=$form->field($searchModel, 'date_end')->widget(DatePicker::className(),[
                    'language' => 'ru',
                    'dateFormat' => 'dd.MM.yyyy',
                    'options'=>['autocomplete'=>'off'],
                ])->label('Дата по:');?>
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <?=Html::submitButton('Поиск',['class'=>'btn btn-primary']);?>
    </div>
    <? \yii\widgets\ActiveForm::end();?>

</div>
<br><br>
<!-- content here -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="<?=($tab == 1)?'active':'';?>"><a href="\tickets?tab=1" >В обработке</a></li>
    <li role="presentation" class="<?=($tab == 2)?'active':'';?>"><a href="\tickets?tab=2" >Отвечен</a></li>
    <li role="presentation" class="<?=($tab == 3)?'active':'';?>"><a href="\tickets?tab=3">Завершен</a></li>
    <li role="presentation" class="<?=($tab == 4)?'active':'';?>"><a href="\tickets?tab=4>" >Все запросы</a></li>
</ul>
<div class="tickets-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'category',
            [
                'attribute'=>'title',
                'content'=>function($data){
                    return Html::a($data['title'],'/tickets/view?id='.$data['id']);
                }
            ],
            //'time:datetime',
            //'user_id',
            [
                'attribute'=>'user_id',
                'content'=>function($data){
                    $username = \common\models\User::findOne($data['user_id']);
                    return Html::a($username['username'],'/users/view?id='.$data['user_id']);

                }
            ],
            [
                'attribute'=>'time',
                'label'=>'Поступил',
                'content'=>function($data){
                    return date("d.m.Y H:i",$data['time']);
                }
            ],
            [
                'attribute'=>'end_time',
                'label'=>'Срок',
                'content'=>function($data){
                    if (is_null($data['end_time'])){
                        $endDate = $data['time']+3600*24*3;
                    }else{
                        $endDate = $data['end_time'];
                    }
                    return date("d.m.Y H:i",$endDate);
                }
            ],
            [
                'attribute'=>'status',
                'content'=>function($data){
                    if($data['status']==3){
                        return "В обработке";
                    }elseif($data['status']==2){
                        return "Отвечен";
                    }elseif($data['status']==1){
                        return "Закрыт";
                    }
                }
            ],


        ],
    ]); ?>
</div>

