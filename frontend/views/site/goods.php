<?php
/* @var $this yii\web\View */
/* @var $goodsList common\models\Goods[] */
?>


<main class="site-main">


    <!-- ================ Blog section start ================= -->
    <section class="blog">
        <div class="container">
            <div class="section-intro pb-60px">
                <h2> <span class="section-intro__style">Жұмыстар</span></h2>
            </div>

            <div class="row">
                <?foreach ($goodsList as $good):?>
                    <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="card card-blog">
                            <div class="card-blog__img">
                                <img class="card-img rounded-0" src="/img/goods.png" alt="">
                            </div>
                            <div class="card-body">
                                <ul class="card-blog__info">
                                    <li><a href="#"><?= $good->author->getFio();?></a></li>
                                </ul>
                                <h4 class="card-blog__title"><a href="/site/good-view?id=<?=$good->id;?>"><?=$good->name;?></a></h4>
                                <p><?=\yii\helpers\StringHelper::truncate($good->content,150,'...');?></p>
                                <a class="/site/good-view?id=<?=$good->id;?>" href="#">Толығырақ <i class="ti-arrow-right"></i></a>
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
