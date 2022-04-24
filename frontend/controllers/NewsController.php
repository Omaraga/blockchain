<?php

namespace frontend\controllers;

use common\models\News;

class NewsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $newsList = News::find()->all();
        return $this->render('index',[
            'newsList' => $newsList,
        ]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
