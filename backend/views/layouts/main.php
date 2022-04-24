<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" style="font-size: 14px;">
    <head>
        <meta charset="utf-8">

        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script src="https://kit.fontawesome.com/baa51cad6c.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="/images/favicon.png" />
        <?
        $this->registerJs("
           CKEDITOR_BASEPATH = '/components/ckeditor/';
           MATHJAX_LIB_PATH = '/components/mathjax/MathJax.js';
        ", \yii\web\View::POS_HEAD, 'ckeditor_config_path');
        $this->registerJsFile("/components/ckeditor/ckeditor.js", ['depends' => [\yii\web\JqueryAsset::className()]]);?>
    </head>
    <body>
    <?php $this->beginBody() ?>
    <div class=" container-scroller">

        <?= $this->render(
            'header.php',
        ) ?>
        <div class="container-fluid">
            <div class="row row-offcanvas row-offcanvas-right">
                <?= $this->render(
                    'left.php'
                )
                ?>
                <div class="content-wrapper">
                    <?= $this->render(
                        'content.php',
                        ['content' => $content]
                    ) ?>
                </div>
                <?=$this->render('footer');?>
            </div>

        </div>




    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
