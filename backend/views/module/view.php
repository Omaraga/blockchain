<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\models\Task;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Module */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Модули'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="module-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить задачи', ['/constructor', 'moduleId' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'label' => 'Курс',
                'value' => function($data){
                    return $data->course->name;
                }
            ],
            'course_id',
            [
                'label' => 'Класс',
                'value'=>function($data){
                    return $data->schoolGrade->name;
                },
            ],
            'icon_url:url',
        ],
    ]) ?>

    <hr>
    <h3>Задачи:</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'label' => '№',
                'content' => function($data){
                    return $data->task->id;
                }
            ],
            [
                'label' => 'Название',
                'content' => function($data){
                    $task = $data->task;
                    return Html::a($task->name,['task/view', 'id' => $task->id]);
                }
            ],
            [
                'label' => 'Изображение',
                'content' => function($data){
                    $url = Yii::$app->params['url'];
                    $imgUrl = $data->task->url;
                    return \backend\models\TaskHelper::getTaskHtml($data->task);
                },
                'format' => 'row',
            ],
            [
                'label' => 'Тема',
                'content' => function($data){
                    $theme = \common\models\Theme::findOne($data->task->theme_id);
                    return $theme ? $theme->name: '';
                }
            ],

            [
                'label' => 'Тип',
                'content' => function($data){
                    $types = Task::getTypes();
                    return $types[$data->task->type];
                }
            ],
            [
                'label' => 'Действия',
                'content' => function($data) use ($model){
                    return Html::a('<i class="fa fa-minus"></i>', Url::to(['/constructor/delete', 'id' => $data->id, 'moduleId' => $model->id, 'url' => (string)'/module/view']), [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Вы действительно хотите отвязать задачу?'),
                            'method' => 'post',
                        ],
                    ]);
                },
                'format' => 'row',
            ],

        ],
    ]); ?>

</div>
