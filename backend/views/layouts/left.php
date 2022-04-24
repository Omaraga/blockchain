<?php

use common\models\User;
$user = Yii::$app->user->identity;

?>
<style>
    .sidebar .nav .nav-item.active > .nav-link{
        font-weight: bold;
    }
</style>
<nav class="bg-white sidebar sidebar-offcanvas" id="sidebar">
    <div class="user-info" style="margin: 10px 0 5px">
        <p class="name"><?=$user ? $user->getShortFio():'';?></p>
        <p class="designation"><?=$user ? $user->getRoleName() : '';?></p>
        <span class="online"></span>
    </div>
    <ul class="nav">
        <?foreach (Yii::$app->params['menuItems'] as $item):?>
            <li class="nav-item <?=\backend\models\BackendHelper::isMenuActive($item['url'])? 'active':''?>">
                <a class="nav-link" href="/<?=$item['url'];?>">
                    <img src="<?=$item['icon'];?>" alt="">
                    <span class="menu-title"><?=$item['name'];?></span>
                </a>
            </li>
        <?endforeach;?>

        <li class="nav-item">
            <a class="nav-link" href="/site/logout" data-method="post">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span class="menu-title">Выход</span>
            </a>
        </li>
    </ul>
</nav>
