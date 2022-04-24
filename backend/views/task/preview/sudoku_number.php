<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use asmoday74\ckeditor5\EditorClassic;
use yii\helpers\ArrayHelper;
use common\models\Theme;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
$model->loadAnswers();
$this->registerJsFile('/js/tasks/sudoku-number.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<style>
    .sudoku-inp{
        text-align: center;
        font-weight: bold;
        font-size: 25px;
        color: darkblue;
    }
</style>
<input type="hidden" id="question" value="<?=htmlspecialchars($model->url);?>">
<input type="hidden" id="answer" value="<?=htmlspecialchars($model->answer[0]);?>">
<div class="row bg-white card">
    <div class="col-md-10 col-md-offset-1 card-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <h4><?=$model->name;?></h4>
            </div>
            <div class="col-md-3 d-none">
                <input type="text" id = "sudoku-size" class="form-control">
            </div>
            <div class="col-1 d-none">
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

