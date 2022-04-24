<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use asmoday74\ckeditor5\EditorClassic;



/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'name')->widget(EditorClassic::className(),[
        'clientOptions' => [
            'uploadUrl' => '/task/upload', 	//url for upload files
            'uploadField' => 'image',	//field name in the upload form
        ]
    ]); ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'theme_id')->textInput() ?>

    <?= $form->field($model, 'help')->fileInput() ?>

    <?= $form->field($model, 'solve')->fileInput() ?>

    <div class="row bg-white card">
        <div class="col-md-10 col-md-offset-1 card-body">
            <h3>Блок задачи</h3>
            fdasf
        </div>
    </div>

    <br>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
