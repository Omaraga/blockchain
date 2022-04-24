<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Country */

$this->title = Yii::t('app', 'Создать Страну');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Страны'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
