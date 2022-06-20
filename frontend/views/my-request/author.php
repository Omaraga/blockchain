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
                'attribute' => 'user_id',
                'value' => function($data){
                    $author = \common\models\User::findOne($data->user_id);
                    if ($author){
                        return $author->getFio();
                    }else{
                        return '';
                    }

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
                'label' => 'Жауап',
                'value' => function($data){
                    return '<a href="/my-request/accept?id='.$data->id.'" class="btn btn-success mr-2">Рұқсат беру</a>'.
                        '<a href="/my-request/decline?id='.$data->id.'" class="btn btn-danger">Бас тарту</a>';
                },
                'format' => 'raw',
            ],
        ],
    ]); ?>


</div>
