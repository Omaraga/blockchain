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
                <p>Надо вводит без пробелов как  в примере, доступные операции +, -, *(умножение), /(деление). Цифры в задаче не должны повторятся. К примеру <span style="color: red">1<span style="color: darkblue;font-weight: bold;">2</span>+40=5<span style="color: darkblue;font-weight: bold;">2</span></span> это не правильная задача.</p>
                <p>12+47=59 получится <i class="fa fa-square-o" aria-hidden="true"></i><i class="fa fa-square-o" aria-hidden="true"></i> +  <i class="fa fa-square-o" aria-hidden="true"></i><i class="fa fa-square-o" aria-hidden="true"></i> = <i class="fa fa-square-o" aria-hidden="true"></i><i class="fa fa-square-o" aria-hidden="true"></i></p>
                <p>2+4=6-0 получится <i class="fa fa-square-o" aria-hidden="true"></i>  + <i class="fa fa-square-o" aria-hidden="true"></i> = <i class="fa fa-square-o" aria-hidden="true"></i> - <i class="fa fa-square-o" aria-hidden="true"></i></p>
                <p>(10-4)*5=30 получится (<i class="fa fa-square-o" aria-hidden="true"></i><i class="fa fa-square-o" aria-hidden="true"></i> - <i class="fa fa-square-o" aria-hidden="true"></i>) * <i class="fa fa-square-o" aria-hidden="true"></i>  = <i class="fa fa-square-o" aria-hidden="true"></i><i class="fa fa-square-o" aria-hidden="true"></i></p>
                <hr>
                <div style="text-align: left">
                    <h3><b>Введите арифметическую задачу</b></h3>
                    <?=$form->field($model,'url')->textInput()->label(false);?>
                </div>

                <hr>
                <div style="text-align: left">
                    <h3><b>Выберите цифры которые будут доступны пользователю для ввода</b></h3>
                    <?=$form->field($model, 'answer')->checkboxList(\common\models\Answer::getArifNumbers(), ['separator' => '<br>'])->label(false)?>
                </div>

            </div>



        </div>
    </div>

    <br>

</div>
