<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Certificate */

$this->title = Yii::t('app', 'Создать Сертификат');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сертификат'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificate-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
