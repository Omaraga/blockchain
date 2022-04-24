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
$this->registerJsFile('/js/tasks/sudoku-img.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<style>
    .sudoku-inp{
        text-align: center;
        font-weight: bold;
        font-size: 25px;
        color: darkblue;
    }
</style>

<div class="task-form">


    <?=$form->field($model, 'url')->hiddenInput(['id' => 'question'])->label(false);?>
    <?=$form->field($model, 'answer[0]')->hiddenInput(['id' => 'answer'])->label(false);?>
    <div class="row bg-white card">
        <div class="col-md-10 col-md-offset-1 card-body">
            <h3 style="text-align: center"><?=$typesList[$type];?></h3>
            <div class="row">
                <div class="col-2 col-md-offset-1">
                    <label for="sudoku-size">Введите размер судоку:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" id = "sudoku-size" class="form-control">
                </div>
                <div class="col-1">
                    <button class="btn btn-success" id = "sudoku-create">OK</button>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div id="sudoku-table" style="text-align: center">

                    </div>
                </div>
            </div>


        </div>
    </div>

    <br>

</div>
