<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\City;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchCity */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Города');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">


    <p>
        <?= Html::a(Yii::t('app', 'Создать Город'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute'=>'country_id',
                'content'=>function($data){
                    $country = \common\models\Country::findOne($data['country_id'] );
                    return $country['name'];
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, City $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
