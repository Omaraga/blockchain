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
        <img src="<?=Yii::$app->params['url']?><?=$model->url;?>" alt="" style="max-width: 100%;">
    </div>
    <br>
    <div class="row">
        <?foreach ($model->answers as $answer):?>
            <div class="col-md-3 col-md-offset-2">
                <div class="<?=$answer->is_correct == 1 ? 'right-answer':'answer'?>">
                    <img src="<?=Yii::$app->params['url']?><?=$answer->url;?>" alt="" style="max-width: 100px;">
                </div>
            </div>
        <?endforeach;?>
    </div>
</div>

