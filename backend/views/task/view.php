<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Task;
/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = 'Задача №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Задачи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="task-view">


    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name:html',
            'score',
            'theme_id',
            [
                'label' => 'Тип',
                'attribute' => 'type',
                'value' => function($data){
                    $types = Task::getTypes();
                    return $types[$data->type];
                }
            ],
            [
                'attribute' => 'help',
                'value' => function($data){
                    $url = Yii::$app->params['url'];
                    return $data->help ? "<img src='$url.$data->help' style='max-width: 150px;'>": '';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'solve',
                'value' => function($data){
                    $url = Yii::$app->params['url'];
                    return $data->solve ? "<img src='$url.$data->solve' style='max-width: 150px;'>": '';
                },
                'format' => 'html'
            ],
          
        ],
    ]) ?>

    <?= $this->render('preview/'.Task::getTypeView($model->type), [
        'model' => $model,
    ]) ?>


</div>
