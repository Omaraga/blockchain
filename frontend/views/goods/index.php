<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Goods;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $user common\models\User */

$this->title = 'Ваши статье, книги, курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">
    <h3>Страница автора: <?=$user->username;?></h3>
    <h5><?= Html::encode($this->title) ?></h5>

    <p>
        <?= Html::a('Загрузить работу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'url:url',
            [
                'attribute' => 'author_id',
                'label' => 'Автор',
                'value' => function($data){
                    return \common\models\User::findOne($data['author_id'])->username;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Goods $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
