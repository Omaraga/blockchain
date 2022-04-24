<?php
use yii\bootstrap\Alert;
/*
 * Выведем все сообщения в цикле.
 */
echo '<div class="fullscreen">';

foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    //Проверим, существует ли сессия по ключу
    if(Yii::$app->getSession()->hasFlash($key)){
        echo Alert::widget([
            'options' => [
                'class' => (in_array($key, ['success', 'info', 'warning', 'danger']) ? 'alert-' . $key : 'alert-info'),
            ],
            'body' => $message,
        ]);
    }


}

echo '</div>';

