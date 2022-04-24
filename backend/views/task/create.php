<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Task;

/* @var $this yii\web\View */
/* @var $currType int */
/* @var $model common\models\Task */

$this->title = Yii::t('app', 'Создать задачу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Задачи'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$types = \common\models\Task::getTypes();
?>
<div class="task-create">

    <h3>Выберите тип</h3>
    <ul class="nav nav-pills">
        <?foreach($types as $index => $type):?>
            <li class="<?=($index == $currType)?'active':''?>"><a href="/task/create?type=<?=$index;?>"><?=$type;?></a></li>
        <?endforeach;?>
    </ul>
    <hr>


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $this->render('main_block', [
        'model' => $model,
        'form' => $form,
    ]) ?>
    <?= $this->render('types/'.Task::getTypeView($currType), [
        'model' => $model,
        'form' => $form,
        'type' => $currType,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
