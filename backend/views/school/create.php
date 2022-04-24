<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\School */

$this->title = Yii::t('app', 'Создать Школу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Школы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="school-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
