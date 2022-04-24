<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Theme;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */

$themes = ArrayHelper::map(Theme::find()->all(),'id', 'name');
$js = <<<JS
$('.task-form').find("textarea[textareatype='ckeditor']").each(function() {
                        CKEDITOR.inline($(this)[0], {
                            customConfig: 'config.js'
                        });
                    });


JS;


$this->registerJs($js);
?>
<style>
    .cke_textarea_inline {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
        display: block;
        width: 100%;
        color: #495057;
        background-color: #fff;
        background-image: none;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    }
</style>
<div class="task-form">

    <?=$this->render('latex');?>
    <div class="form-group field-task-name">
        <label for="question_name">Введите вопрос:</label>
        <textarea textareatype="ckeditor" cktype="inline" class="form-control" id="task-name" name="Task[name]" rows="1" placeholder="<?=Yii::t("main","Введите свой вопрос")?>"><?=$model->name?></textarea>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'theme_id')->dropDownList($themes) ?>

    <table style="border: none; width: 100%;">
        <tr>
            <td><b>Помощь</b></td>
        </tr>
        <tr style="border: none; padding: 10px;">
            <td style="border: none; padding: 10px;">
                <div class="form-group field-task-help_text">
                    <textarea textareatype="ckeditor" cktype="inline" class="form-control" id="task-name" name="Task[help_text]" rows="1" placeholder="<?=Yii::t("main","Введите свой вопрос")?>"><?=$model->help_text?></textarea>
                    <div class="help-block"></div>
                </div>
            </td>
            <?if($model->help):?>
                <td style="border: none; padding: 10px;"><img src="<?=Yii::$app->params['url'];?><?=$model->help;?>" alt="" style="max-width: 150px"></td>
            <?endif;?>
            <td style="border: none"><?= $form->field($model, 'helpImg')->fileInput()->label(false) ?></td>
        </tr>
        <tr>
            <td><b>Решение</b></td>
        </tr>
        <tr style="border: none">
            <td style="border: none; padding: 10px;">
                <div class="form-group field-task-solve_text">
                    <textarea textareatype="ckeditor" cktype="inline" class="form-control" id="task-name" name="Task[solve_text]" rows="1" placeholder="<?=Yii::t("main","Введите свой вопрос")?>"><?=$model->solve_text?></textarea>
                    <div class="help-block"></div>
                </div>
            </td>
            <?if($model->solve):?>
                <td style="border: none"><img src="<?=Yii::$app->params['url'];?><?=$model->solve;?>" alt="" style="max-width: 150px"></td>
            <?endif;?>
            <td style="border: none"> <?= $form->field($model, 'solveImg')->fileInput()->label(false) ?></td>
        </tr>

    </table>

    <br>




</div>
