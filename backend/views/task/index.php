<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Task;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Банк задач');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">
    <p>
        <?= Html::a(Yii::t('app', 'Создать задачу'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'content' => function($data){
                    return "№".$data['id'];
                }
            ],

            [
                'attribute'=>'name',
                'content'=>function($data){
                    return Html::a($data['name'],'/task/view?id='.$data['id']);
                },
                'format' => 'raw'
            ],


            [
                'label' => 'Тема',
                'attribute' => 'theme_id',
                'content' => function($data){
                    $theme = \common\models\Theme::findOne($data->theme_id);
                    return $theme ? $theme->name: '';
                }
            ],

            [
                'label' => 'Тип',
                'attribute' => 'type',
                'content' => function($data){
                    $types = Task::getTypes();
                    return $types[$data->type];
                }
            ],

            [
                'content' => function($data){
                    $url = Yii::$app->params['url'];
                    return \backend\models\TaskHelper::getTaskHtml($data);

                },
                'format' => 'row',
            ],
            'score',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Task $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
