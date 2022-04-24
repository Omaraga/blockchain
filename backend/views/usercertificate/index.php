<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Usercertificate;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchUsercertificate */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Сертификаты пользователей');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usercertificate-index">

    <p>
        <?= Html::a(Yii::t('app', 'Создать Сертификаты пользователей'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'target_id',
            'related_id',
            'url:url',
            [
                'attribute'=>'created_at',
                'content'=>function($data){
                    if(!empty($data['created_at'])){
                        return date("d.m.Y H:i",$data['created_at']);
                    }
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Usercertificate $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
