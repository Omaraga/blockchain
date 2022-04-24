<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
<style>
    .brand-logo span{
        font-size: 18px;
        font-weight: bold;
        color: purple;
    }
    .rounded-circle{
        background-color: azure;
        padding: 10px;
        color: purple;
        font-weight: bold;

    }
</style>
<nav class="navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="bg-white text-center navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="/"><?=\backend\models\BackendHelper::getLogo();?></a>
        <a class="navbar-brand brand-logo-mini" href="/"><?=\backend\models\BackendHelper::getLogo(true);?></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler d-none d-lg-block navbar-dark align-self-center mr-3" type="button" data-toggle="minimize">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav ml-lg-auto d-flex align-items-center flex-row">
            <li class="nav-item">
                <?if(!Yii::$app->user->isGuest):?>
                    <a class="nav-link profile-pic" href="/site/profile"><span class="rounded-circle"><?=Yii::$app->user->identity->getFioInitials();?></span></a>
                <?endif;?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?=\backend\models\BackendHelper::getUrl();?>" target="_blank"><i class="fa fa-th"></i></a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-dark navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>
</nav>
