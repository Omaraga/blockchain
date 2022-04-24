<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\School;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchSchool */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Школы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-index">


    <p>
        <?= Html::a(Yii::t('app', 'Создать Школу'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'attribute'=>'city_id',
                'content'=>function($data){
                    $city = \common\models\City::findOne($data['city_id'] );
                    return $city['name'];
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, School $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
