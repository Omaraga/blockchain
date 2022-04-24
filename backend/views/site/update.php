<?php

/* @var $this yii\web\View */
/* @var $model common\models\Settings */

use yii\widgets\ActiveForm;

$this->title = 'Редактирование сайта';
$js = <<<JS
$('#add-phone').click(function (e){
   e.preventDefault();
   $(this).before('<input type="text" class="form-control mb-1" name="Settings[phoneList][]" value="" maxlength="255">');
});
JS;
$this->registerJs($js);
?>

<section>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    <?if($model->logo):?>
        <img src="<?=$model->url;?><?=$model->logo;?>" alt="" style = "max-width:100px">
    <?endif;?>
    <?= $form->field($model, 'image')->fileInput(); ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-settings-phoneList">
        <label class="control-label" for="phone-url">Номера телефонов</label>
        <?foreach ($model->phoneList as $phone):?>
            <input type="text" class="form-control mb-1" name="Settings[phoneList][]" value="<?=$phone;?>" maxlength="255">

        <?endforeach;?>
        <a class="btn btn-info mt-3" href="#" id="add-phone"><i class="fa fa-plus-circle" aria-hidden="true" ></i>
        </a>
        <div class="help-block"></div>
    </div>




    <div class="form-group">
        <?= \yii\bootstrap4\Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</section>

