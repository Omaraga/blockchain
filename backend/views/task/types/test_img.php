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
            <h4 style="font-weight: bold">Картинка вопроса</h4>
            <table style="border: none">
                <tr style="border: none; padding: 10px;">
                    <?if($model->url):?>
                        <td style="border: none; padding: 10px;"><img src="<?=Yii::$app->params['url'];?><?=$model->url;?>" alt="" style="max-width: 250px"></td>
                    <?endif;?>
                    <td style="border: none"> <?=$form->field($model, 'mainImg')->fileInput();?></td>
                </tr>


            </table>
            <hr>
            <h4 style="font-weight: bold">Ответы</h4>
            <h5>Правильный ответ</h5>
            <table style="border: none">
                <tr style="border: none; padding: 10px;">
                    <?if($rightAns = $model->getAnswerByIndex(0)):?>
                        <td style="border: none; padding: 10px;"><img src="<?=Yii::$app->params['url'];?><?=$rightAns->url;?>" alt="" style="max-width: 150px"></td>
                    <?endif;?>
                    <td style="border: none"> <?=$form->field($model, 'answer[0]')->fileInput()->label(false);?></td>
                </tr>
            </table>


            <h5>Другие ответы</h5>
            <table style="border: none">
                <?for ($i = 1; $i < 5; $i++):?>
                    <tr style="border: none; padding: 10px;">
                        <?if($ans = $model->getAnswerByIndex($i)):?>
                            <td style="border: none; padding: 10px;"><img src="<?=Yii::$app->params['url'];?><?=$ans->url;?>" alt="" style="max-width: 150px"></td>
                        <?endif;?>
                        <td style="border: none"> <?=$form->field($model, "answer[$i]")->fileInput()->label(false);?></td>
                    </tr>
                <?endfor;?>
            </table>



        </div>
    </div>

    <br>

</div>
