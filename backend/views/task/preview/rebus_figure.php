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
        </div>
    </div>

    <br>

</div>
