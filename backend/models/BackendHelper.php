<?php

namespace backend\models;
use common\models\Settings;
use yii\base\Model;
class BackendHelper extends Model
{

    /**
     * @return mixed|string|null
     */
    public static function getUrl(){
        $settings = self::getSetting();
        if ($settings && $settings->url){
            return $settings->url;
        }else{
            return \Yii::$app->params['url'];
        }
    }

    /**
     * @return array|Settings|\yii\db\ActiveRecord
     */
    public static function getSetting(){
       return Settings::find()->one() ? : new Settings();
    }

    public static function getLogo($mini = false){
        $settings = self::getSetting();

        if ($mini){
            $link = ($settings->logo) ? self::getUrl().$settings->logo :'/images/logo_star_mini.jpg';
            return '<img src="'.$link.'" style = "max-width:50px"/>';
        }else{
            $link = ($settings->logo) ? self::getUrl().$settings->logo :'/images/logo_star_black.png';
            return '<img src="'.$link.'" style = "max-width:50px;float: left;margin-left: 10px;"/> <span>'.$settings->name.'</span>';
        }
    }

    public static function isMenuActive($url){
        $route =  \Yii::$app->controller->getRoute(); //TODO написать route
        $routeArray = explode('/',$route);
        $urlArray = explode('/', $url);
        if ($routeArray[0] == $urlArray[0]){
            return true;
        }else{
            return false;
        }
    }

    public static function getName(){
        $setting = self::getSetting();
        if ($setting->name){
            return $setting->name;
        }else{
            return 'Админ панель';
        }
    }


}