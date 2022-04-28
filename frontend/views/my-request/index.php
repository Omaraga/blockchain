<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Менің тапсырыстарым';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'good_id',
                'value' => function($data){
                    $good = \common\models\Goods::findOne($data->good_id);
                    return $good->name;
                }
            ],
            [
                'attribute' => 'author_id',
                'value' => function($data){
                    $author = \common\models\User::findOne($data->author_id);
                    return $author->getFio();
                }
            ],
            'code',
            [
                'attribute' => 'status',
                'value' => function($data){
                    $statusList = \common\models\Request::getStatusList();
                    return $statusList[$data->status];
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, \common\models\Request $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
