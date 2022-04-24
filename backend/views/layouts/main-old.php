<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$bundle = yiister\gentelella\assets\Asset::register($this);
$user = Yii::$app->user->identity;
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>" >
<?php $this->beginBody(); ?>
<div class="container body">

    <div class="main_container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><i class="fa fa-paw"></i> <span>LogicMath</span></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav visible-xs">
                        <li><a href="/users">Пользователи</a></li>
                        <li><a href="/school-grade">Классы</a></li>
                        <li><a href="/course">Курсы</a></li>
                        <li><a href="/module">Модули</a></li>
                        <li><a href="/theme">Темы задач</a></li>
                        <li><a href="/task">Банк задач</a></li>
                        <li><a href="/constructor">Конструктор</a></li>
                        <li><form action="/site/logout" method="post">
                                <input type="submit" value="Выход">
                            </form></li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right hidden-xs">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$user->fio;?> <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="/site/logout" method="post">
                                        <input type="submit" value="Выход">
                                    </form>

                                </li>

                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">


                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side main_menu">

                    <div class="menu_section">
                        <?=
                        \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => [
                                    ["label" => "Главная", "url" => "/", "icon" => "home"],
                                    ["label" => "Пользователи", "url" => ["/users"], "icon" => "user"],
                                    ["label" => "Классы", "url" => ["/school-grade"], "icon" => "graduation-cap"],
                                    [
                                        "label" => "Работа с задачами",
                                        "icon" => "tasks",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "Курсы", "url" => ["/course"]],
                                            ["label" => "Модули", "url" => ["/module"]],
                                            ["label" => "Темы задач", "url" => ["/theme"]],
                                            ["label" => "Банк задач", "url" => ["/task"]],
                                            ["label" => "Конструктор", "url" => ["/constructor"]],
                                        ],
                                    ],
                                    [
                                        "label" => "Сертификаты",
                                        "icon" => "certificate",
                                        "url" => "#",
                                        "items" => [
                                            ["label" => "Управление", "url" => ["/certificate"]],
                                            ["label" => "Запросы", "url" => ["/certreq"]],
                                        ],
                                    ],
                                    ["label" => "Подписки", "url" => ["/request"], "icon" => "money"],
                                    ["label" => "Техподдержка", "url" => ["/request"], "icon" => "weixin"],

                                ],
                            ]
                        )
                        ?>
                    </div>

                </div>

            </div>
        </div>


        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <? echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);?>
            <?= $content ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
