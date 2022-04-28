<?php

/** @var yii\web\View $this */
/** @var common\models\News[] $newsList */
/** @var common\models\Goods[] $goodList */

$this->title = 'My Yii Application';
?>
<main class="site-main">

    <!--================ Hero banner start =================-->
    <section class="hero-banner">
        <div class="container">
            <div class="row no-gutters align-items-center pt-60px">
                <div class="col-5 d-none d-sm-block">
                    <div class="hero-banner__img pb-5">
                        <img class="img-fluid" src="/img/home/home-banner.jpg" alt="" style="max-width: 100%;">
                    </div>
                </div>
                <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0 pb-5">
                    <div class="hero-banner__content">
                        <h4>BlockChain</h4>
                        <h1>инфрақұрылымына</h1>
                        <p>әдістемелік негіздері</p>
                        <a class="button button-hero" href="#">Бастау</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero banner start =================-->


    <!-- ================ trending product section start ================= -->
    <section class="section-margin calc-60px">
        <div class="container">
            <div class="section-intro pb-60px">
                <p>Сізге қызықты болуы мүмкін</p>
                <h2>Трендтегі <span class="section-intro__style">жұмыстар</span></h2>
            </div>
            <div class="row">
                <?foreach ($goodList as $good):?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card text-center card-product">
                        <div class="card-product__img">
                            <img class="card-img" src="/img/goods.png" alt="">
                            <ul class="card-product__imgOverlay">
                                <li><button><i class="ti-search"></i></button></li>
                                <li><button><i class="ti-shopping-cart"></i></button></li>
                                <li><button><i class="ti-heart"></i></button></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <p><?=$good->author->getFio();?></p>
                            <h4 class="card-product__title"><a href="/site/good-view?id=<?=$good->id;?>"><?=$good->name;?></a></h4>

                        </div>
                    </div>
                </div>
                <?endforeach;?>


            </div>
        </div>
    </section>
    <!-- ================ trending product section end ================= -->


    <!-- ================ Blog section start ================= -->
    <section class="blog">
        <div class="container">
            <div class="section-intro pb-60px">
                <h2>Соңғы <span class="section-intro__style">Жаңалықтар</span></h2>
            </div>

            <div class="row">
                <?foreach ($newsList as $news):?>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="card card-blog">
                            <div class="card-blog__img">
                                <img class="card-img rounded-0" src="<?=$news->image;?>" alt="">
                            </div>
                            <div class="card-body">
                                <ul class="card-blog__info">
                                    <li><a href="#"><?=date('d.M.y ж', $news->created_at);?></a></li>
                                </ul>
                                <h4 class="card-blog__title"><a href="single-blog.html"><?=$news->title;?></a></h4>
                                <p><?=\yii\helpers\StringHelper::truncate($news->content,150,'...');?></p>
                                <a class="card-blog__link" href="#">Толығырақ <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </section>
    <!-- ================ Blog section end ================= -->

    <!-- ================ Subscribe section start ================= -->

    <!-- ================ Subscribe section end ================= -->



</main>
