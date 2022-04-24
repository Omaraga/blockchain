<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Module */
/* @var $form yii\widgets\ActiveForm */

$courses = ArrayHelper::map(\common\models\Course::find()->all(), 'id', 'name');
$schoolGrades = ArrayHelper::map(\common\models\SchoolGrade::find()->all(), 'id', 'name');
?>

<div class="module-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_id')->dropDownList($courses, []) ?>

    <?= $form->field($model, 'icon_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'class_id')->dropDownList($schoolGrades) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
