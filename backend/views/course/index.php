<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use richardfan\sortable\SortableGridView;
use common\models\Course;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Курсы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <p>
        <?= Html::a(Yii::t('app', 'Создать курс'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,

        // you can choose how the URL look like,
        // but it must match the one you put in the array of controller's action()
        'sortUrl' => Url::to(['/course/sortItem']),

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute'=>'name',
                'content'=>function($data){
                    return Html::a($data['name'],'/course/view?id='.$data['id']);
                },
                'format' => 'raw'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Course $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>



</div>
