<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use asmoday74\ckeditor5\EditorClassic;
use yii\helpers\ArrayHelper;
use common\models\Theme;

/* @var $this yii\web\View */
/* @var $model common\models\Task */

?>

<div class="row card">
    <div class="col-md-4 col-md-offset-4">

        <h4><?=$model->name;?></h4>
    </div>
    <hr>
    <div class="col-md-12">
        <div class="jumbotron">
            <p><?=$model->answers->name;?></p>


        </div>
    </div>

</div>

