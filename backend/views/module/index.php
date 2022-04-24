<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use common\models\Module;
use richardfan\sortable\SortableGridView;


/* @var $this yii\web\View */
/* @var $tabs array */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Модули');
$this->params['breadcrumbs'][] = $this->title;

$courses = \common\models\Course::find()->orderBy('order_col ASC')->all();
$schoolGrades = \common\models\SchoolGrade::find()->all();

?>

<div class="module-index">

    <p>
        <?= Html::a(Yii::t('app', 'Создать модуль'), ['create', 'course' => $tabs['course'], 'grade' => $tabs['grade']], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="card top-tab">
        <ul class="nav nav-tabs">
            <?foreach ($courses as $course):?>
                <li class="<?=($course->id == $tabs['course']) ?'active':''?>">
                    <?=Html::a($course->name, ['/module/index','course' => $course->id, 'grade' => $tabs['grade']]);?>
                </li>
            <?endforeach;?>
        </ul>
    </div>

    <div class="card bot-tab">
        <ul class="nav nav-tabs">
            <?foreach ($schoolGrades as $grade):?>
                <li class="<?=($grade->id == $tabs['grade']) ?'active':''?>">
                    <?=Html::a($grade->name, ['/module/index','course' => $tabs['course'], 'grade' => $grade->id]);?>
                </li>
            <?endforeach;?>
        </ul>
    </div>
    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,

        // you can choose how the URL look like,
        // but it must match the one you put in the array of controller's action()
        'sortUrl' => Url::to(['/module/sortItem']),

        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'name',
                'content'=>function($data){
                    return Html::a($data['name'],'/module/view?id='.$data['id']);
                },
                'format' => 'raw'
            ],
            [
                'label'=>'Курс',
                'content'=>function($data){
                    return $data->course->name;
                },

            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Module $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>





</div>
