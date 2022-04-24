<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use asmoday74\ckeditor5\EditorClassic;
use yii\helpers\ArrayHelper;
use common\models\Theme;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */
/* @var $type int */
$typesList = \common\models\Task::getTypes();
?>

<div class="task-form">


    <div class="row bg-white card">
        <div class="col-md-10 col-md-offset-1 card-body">
            <h3 style="text-align: center"><?=$typesList[$type];?></h3>

            <table style="border: none">
                <tr style="border: none; padding: 10px;">
                    <?if($model->url):?>
                        <td style="border: none; padding: 10px;"><img src="<?=Yii::$app->params['url'];?><?=$model->url;?>" alt="" style="max-width: 150px"></td>
                    <?endif;?>
                    <td style="border: none"> <?=$form->field($model, 'mainImg')->fileInput();?></td>
                </tr>


            </table>
            <hr>

            <h5>Правильный ответ</h5>
            <?=$form->field($model, 'answer[0]')->textInput()->label(false);?>
            <h5>Другие ответы</h5>
            <?=$form->field($model, 'answer[1]')->textInput()->label(false);?>
            <?=$form->field($model, 'answer[2]')->textInput()->label(false);?>
            <?=$form->field($model, 'answer[3]')->textInput()->label(false);?>
            <?=$form->field($model, 'answer[4]')->textInput()->label(false);?>
        </div>
    </div>

    <br>

</div>
