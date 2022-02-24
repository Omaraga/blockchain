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
                    <li class="nav-item active"><a class="nav-link" href="<?=$item['url'][0];?>"><?=$item['label'];?></a></li>
                    <?endforeach;?>

                </ul>

                <ul class="nav-shop">
                    <li class="nav-item"><button><i class="ti-search"></i></button></li>
                    <li class="nav-item"><button><i class="ti-shopping-cart"></i><span class="nav-shop__circle">3</span></button> </li>
                    <li class="nav-item"><a class="button button-header" href="#">Buy Now</a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>