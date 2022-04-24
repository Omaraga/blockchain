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
            <div class="jumbotron">
                <h3><b>Правила составления задач</b></h3>
                <p>Надо вводит без пробелов как в примере, доступные операции +, -, *(умножение), /(деление) </p>
                <p>12+43=55 получится 12 <i class="fa fa-square-o" aria-hidden="true"></i> 43 = 55</p>
                <p>12+43=50+5 получится 12 <i class="fa fa-square-o" aria-hidden="true"></i> 43 = 50  <i class="fa fa-square-o" aria-hidden="true"></i> 5</p>
                <p>100-40*2=20 получится 100 <i class="fa fa-square-o" aria-hidden="true"></i> 40 = 20</p>
                <p>(100-40)*2=120 получится (100 <i class="fa fa-square-o" aria-hidden="true"></i> 40) <i class="fa fa-square-o" aria-hidden="true"></i> 2 = 120</p>
                <hr>
                <div style="text-align: left">
                    <h3><b>Введите арифметическую задачу</b></h3>
                    <?=$form->field($model,'url')->textInput()->label(false);?>
                </div>

                <hr>
                <div style="text-align: left">
                    <h3><b>Выберите операции которые будут доступны пользователю для ввода</b></h3>
                    <?=$form->field($model, 'answer')->checkboxList(\common\models\Answer::getArifSigns(), ['separator' => '<br>'])->label(false)?>
                </div>

            </div>



        </div>
    </div>

    <br>

</div>
