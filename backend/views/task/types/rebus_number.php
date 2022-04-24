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

$this->registerJsFile('/js/tasks/rebus-number.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="task-form">


    <?=$form->field($model, 'url')->hiddenInput(['id' => 'question'])->label(false);?>
    <div class="row bg-white card">
        <div class="col-md-10 col-md-offset-1 card-body">
            <h3 style="text-align: center"><?=$typesList[$type];?></h3>
            <div class="jumbotron">
                <h3><b>Правила составления ребуса с числами</b></h3>
                <p>1. Надо ввести правильный вариант без пробелов как  в примере и нажать ОК. Доступные операции +, -, *(умножение), /(деление). Пример: <span style="font-weight: bold; color: blue">123+256+10=389</span></p>
                <p>2. Снизу должно появиться несколько полей ввода, в зависимости от введенного вами правильного варианта. Эти поля предназначены для определения какие цифры будут открытыми а какие закрыты. Чтобы закрыть цифру от пользователя введитe <span style="font-weight: bold; color: blue"># (решетка)</span>.
                    Пример: первый аргумент из 1 пункта <span style="font-weight: bold; color: blue">123</span>, чтобы скрыть 1 цифру <span style="font-weight: bold; color: blue"><b>#</b>23</span>. Пользователь увидит <span style="font-weight: bold; color: red"><i class="fa fa-square-o" aria-hidden="true"></i>23</span></p>
                <hr>


            </div>
            <h3><b>Введите правильный вариант ребуса</b></h3>
            <div class="row">
                <div class="col-md-9">
                    <?=$form->field($model,'answer')->textInput(['placeholder' => '123+256+10=389', 'id' => 'rebus-right'])->label(false);?>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary" id="rebus-ok">OK</button>
                </div>
            </div>
            <hr>
            <h3><b>Определите закрытые цифры символом #</b></h3>
            <div class="row">
                <div id="rebus-inp" class="col-md-3">

                </div>
            </div>





        </div>
    </div>

    <br>

</div>
