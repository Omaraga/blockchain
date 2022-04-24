<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use common\models\Task;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TaskSearch */
/* @var $module common\models\Module */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Конструктор модуля');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="task-index">

    <?= DetailView::widget([
        'model' => $module,
        'attributes' => [
            [
                'label' => 'Название',
                'value' => function($data){
                    return Html::a($data->name, ['/module/view', 'id' => $data->id]);
                },
                'format' => 'html',
            ],
            [
                'label' => 'Курс',
                'value' => function($data){
                    return $data->course->name;
                }
            ],
            [
                'label' => 'Класс',
                'value'=>function($data){
                    return $data->schoolGrade->name;
                },
            ],

        ],
    ]) ?>
    <hr>
    <h3>Поиск</h3>
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'options' => ['style' => 'width:10%;'],
                'label' => '№',
                'content' => function($data){
                    return $data['id'];
                }
            ],
            'name:html',
            [
                'label' => 'Изображение',
                'content' => function($data){
                    $url = Yii::$app->params['url'];
                    return \backend\models\TaskHelper::getTaskHtml($data);
                },
                'format' => 'row',
            ],
            [
                'label' => 'Тема',
                'content' => function($data){
                    $theme = \common\models\Theme::findOne($data->theme_id);
                    return $theme ? $theme->name: '';
                }
            ],

            [
                'label' => 'Тип',
                'content' => function($data){
                    $types = Task::getTypes();
                    return $types[$data->type];
                }
            ],
            [
                'label' => 'Действия',
                'content' => function($data) use ($module){
                    $connection = \common\models\ModuleTask::find()->where(['target_id' => $module->id, 'related_id' => $data->id])->one();
                    if ($connection){
                        return Html::a('<i class="fa fa-minus"></i>', Url::to(['/constructor/delete', 'id' => $connection->id, 'moduleId' => $module->id]), [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => Yii::t('app', 'Вы действительно хотите отвязать задачу?'),
                                'method' => 'post',
                            ],
                        ]);
                    }else{
                        return Html::a('<i class="fa fa-plus"></i>',Url::to(['constructor/create', 'moduleId' => $module->id, 'taskId' => $data->id]),['class' => 'btn btn-success']);
                    }
                },
                'format' => 'row',
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
