<?php

use dosamigos\fileinput\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */
/* @var $type int */
$typesList = \common\models\Task::getTypes();
$currAnswer = $model->answers;
$images = $currAnswer ? json_decode($currAnswer->url) : [];
$maxSize = $currAnswer ? sizeof($images): 10;
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

    <?if($currAnswer):?>
        <input type="hidden" id="answerUrl" value="<?=htmlspecialchars($currAnswer->url);?>" data-url="<?=Yii::$app->params['url'];?>">
    <?endif;?>
    <?=$form->field($model, 'url')->hiddenInput(['id' => 'question'])->label(false);?>
    <?=$form->field($model, 'answer')->hiddenInput(['id' => 'answer'])->label(false);?>
    <div class="row bg-white card">
        <div class="col-md-10 col-md-offset-1 card-body">
            <h3 style="text-align: center"><?=$typesList[$type];?></h3>
            <div class="row <?=($currAnswer)?'d-none':''?>">
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
                <div class="col-md-12" id = 'sudo-files'>
                    <h4><?=$currAnswer?'Редактирование картинок судоку':'Загрузите картинки судоку';?></h4>
                    <?for($i = 0; $i < $maxSize; $i ++):?>

                        <?=FileInput::widget([
                            'model' => $model,
                            'attribute' => 'files['.$i.']', //  is the attribute
                            'style' => FileInput::STYLE_IMAGE,
                            'options' => ['class' => "sudoku-img"],
                        ]);?>
                    <?endfor;?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 mb-2">
                    <h4>Текущие картинки судоку</h4>
                </div>

                <?if($currAnswer):?>
                    <?$i = 1;?>
                    <?foreach ($images as $image):?>
                        <div class="col-2">
                            <h5>№<?=$i;?> картинка</h5>
                            <img src="<?=Yii::$app->params['url'];?><?=$image;?>" alt="" style="max-width: 90%;">
                        </div>
                        <?$i++;?>
                    <?endforeach;?>
                <?endif;?>
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
