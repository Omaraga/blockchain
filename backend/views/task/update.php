<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Task;
/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = Yii::t('app', 'Редактирование задачи: {id}', [
    'id' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Задачи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>
<div class="task-update">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $this->render('main_block', [
        'model' => $model,
        'form' => $form,
    ]) ?>
    <?= $this->render('types/'.Task::getTypeView($model->type), [
        'model' => $model,
        'form' => $form,
        'type' => $model->type,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
