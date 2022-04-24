<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Usercertificate */

$this->title = Yii::t('app', 'Создать сертификат пользователя');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сертификаты пользователей'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usercertificate-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
