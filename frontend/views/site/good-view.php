<?php
/* @var $this yii\web\View */
/* @var $good common\models\Goods */
?>

<section>
    <h1><?=$good->name;?></h1>
    <h4><?=$good->author->getFio();?></h4>
    <p>
        <?=$good->content;?>
    </p>

    <a class="btn btn-primary" href="/goods/request?id=<?=$good->id;?>">Тапсырыс беру</a>
</section>
