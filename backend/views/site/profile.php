<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Profile */

use yii\widgets\ActiveForm;

$this->title = 'Профиль';

?>

<section>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'disabled' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= \yii\bootstrap4\Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</section>

