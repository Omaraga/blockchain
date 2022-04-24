<?php

/* @var $this yii\web\View */
/* @var $model common\models\Settings */

use yii\widgets\ActiveForm;
$this->title = 'Настройки сайта';
?>

<section>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'disabled' => true]) ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true,  'disabled' => true]) ?>
    <div class="form-group field-settings-phoneList">
        <label class="control-label" for="phone-url">Логотип</label>
        <br>
        <img src="<?=$model->url;?><?=$model->logo;?>" alt="" style = "max-width:100px">
    </div>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true,  'disabled' => true]) ?>
    <div class="form-group field-settings-phoneList">
        <label class="control-label" for="phone-url">Номера телефонов</label>
        <?foreach ($model->phoneList as $phone):?>
            <input type="text" class="form-control" name="Settings[phoneList][]" value="<?=$phone;?>" maxlength="255" disabled>

        <?endforeach;?>
    </div>




    <div class="form-group">
        <a href="/site/update-settings" class="btn btn-danger">Редактировать</a>
    </div>

    <?php ActiveForm::end(); ?>
</section>

