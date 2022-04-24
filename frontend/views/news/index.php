<?php
/* @var $this yii\web\View */
/* @var $newsList common\models\News[] */
?>


<main class="site-main">


    <!-- ================ Blog section start ================= -->
    <section class="blog">
        <div class="container">
            <div class="section-intro pb-60px">
                <h2> <span class="section-intro__style">Жаңалықтар</span></h2>
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
                                    <li><a href="#"><?=date('d.M.Y ж', $news->created_at);?></a></li>
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
