<?php
/* @var $content string */
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap\Alert;

?>
<section class="content-header">
    <?php if (isset($this->blocks['content-header'])) { ?>
        <h3 class="page-heading mb-4"><?= $this->blocks['content-header'] ?></h3>
    <?php } else { ?>
        <h1>
            <?php
            if ($this->title !== null) {
                echo \yii\helpers\Html::encode($this->title);
            } else {
                echo \yii\helpers\Inflector::camel2words(
                    \yii\helpers\Inflector::id2camel($this->context->module->id)
                );
                echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Модуль</small>' : '';
            } ?>
        </h1>
    <?php } ?>

    <?=
    Breadcrumbs::widget(
        [
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]
    ) ?>
</section>

<section class="content">

    <?= $this->render('_messages'); ?>
    <div class="card" style="border-radius: 10px;">
        <div class="card-body">
            <?= $content ?>
        </div>
    </div>

</section>

