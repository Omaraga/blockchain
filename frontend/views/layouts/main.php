<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header class="header_area">
    <?php
    $menuItems = [
        ['label' => 'Басты', 'url' => ['/site/index']],
        ['label' => 'Жаңалықтар', 'url' => ['/news/index']],
        ['label' => 'Жұмыстар', 'url' => ['/site/goods']],
    ];
    if (Yii::$app->user->isGuest) {

        $menuItems[] = ['label' => 'Тіркелу', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Кіру', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => 'Менің жұмыстарым', 'url' => ['/goods/index']];
        $menuItems[] = ['label' => 'Менің тапсырыстарым', 'url' => ['/my-request']];
        $menuItems[] = ['label' => 'Жұмыстарға сұраныс', 'url' => ['/my-request/author']];
        $menuItems[] = ['label' => 'Шығу', 'url' => ['/site/logout']];
//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
    }
    echo $this->render('header',[
        'menuItems' => $menuItems,
    ]);
    ?>

</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-left">&copy; Blockchain <?= date('Y') ?></p>
        <p class="float-right">Zhalelov Erzhan</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
