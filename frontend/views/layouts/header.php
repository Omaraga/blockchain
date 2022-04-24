<?php
/* @var $menuItems array*/

?>

<div class="main_menu">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand logo_h" href="/"><img src="/img/logo.png" alt="" style="max-width: 150px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                    <?foreach($menuItems as $item):?>
                    <li class="nav-item active"><a class="nav-link" href="<?=$item['url'][0];?>" ><?=$item['label'];?></a></li>
                    <?endforeach;?>

                </ul>

                <?if(!Yii::$app->user->isGuest):?>
                    <ul class="nav-shop">
                        <li class="nav-item"><a class="button button-header" href="#"><?=Yii::$app->user->identity->getShortFio()?></a></li>
                    </ul>
                <?endif;?>
            </div>
        </div>
    </nav>
</div>
