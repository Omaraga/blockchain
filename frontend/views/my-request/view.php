<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use xj\qrcode\widgets\Text;

/* @var $this yii\web\View */
/* @var $model common\models\Request */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'тапсырыстар', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$good = \common\models\Goods::findOne($model->good_id);
?>
<div class="request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'good_id',
                'value' => function($data){
                    $good = \common\models\Goods::findOne($data->good_id);
                    return $good->name;
                }
            ],
            [
                'attribute' => 'author_id',
                'value' => function($data){
                    $author = \common\models\User::findOne($data->author_id);
                    return $author->getFio();
                }
            ],
            'code',
            [
                'attribute' => 'status',
                'value' => function($data){
                    $statusList = \common\models\Request::getStatusList();
                    return $statusList[$data->status];
                }
            ],

        ],
    ]) ?>

    <?if($model->status == \common\models\Request::STATUS_ACCEPT):?>
        <a href="<?=$good->url;?>" download><?=$good->name;?></a>
        <div class="row">
            <div class="col">
                <?echo Text::widget([
                    'outputDir' => '@frontend/web/upload/qrcode',
                    'outputDirWeb' => '/upload/qrcode',
                    'ecLevel' => \xj\qrcode\QRcode::QR_ECLEVEL_L,
                    'text' =>'blockchain: '. $model->code.' to work: '.$good->name. ' author: '.$good->author->getFio(),
                    'size' => 6,
                ]);?>
            </div>
        </div>

    <?endif;?>

</div>
