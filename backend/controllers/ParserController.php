<?php

namespace backend\controllers;
use common\models\City;
use common\models\Region;
use Yii;
use GuzzleHttp\Client; // подключаем Guzzle
use yii\helpers\Url;
use yii\web\Controller;
class ParserController extends Controller
{

    public function actionIndex(){
        // создаем экземпляр класса
        die;
        $client = new Client();
        // отправляем запрос к странице Яндекса
        $res = $client->request('GET', 'https://findhow.org/939-spisok-obshheobrazovatelnyih-shkol-v-kazahstane.html?region=turkestan');
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        $document = \phpQuery::newDocumentHTML($body);
        //Смотрим html страницы Яндекса, определяем внешний класс списка и считываем его командой find
        $table = $document->find(".school-list-table");
        $schools = $table->find('tr');
        $cityId = 17;
        $city = City::findOne($cityId);
        $data = [];
        foreach ($schools as $school){
            $str = pq($school)->find('div::first-child')->text();
            $regionName = preg_replace('/Местоположение:/','',$str, 1);
            if (strlen($regionName) > 0){
                $dbRegion = Region::find()->where(['parent' => $city->id])->andWhere(['like', 'name', $regionName])->one();
                if (!$dbRegion){
                    $dbRegion = new Region();
                    $dbRegion->name = $regionName;
                    $dbRegion->parent = $city->id;
                    $dbRegion->save();
                }
                echo $regionName.' ~ ';
                $str2 =  pq($school)->find('td::first-child')->text();
                $name = preg_replace('/[0-9]+./', '', $str2,1);
                if (strlen($name) > 0){
                    $arr = [$name , $city->id, $dbRegion->id];
                    $data[] = $arr;
                    echo $name.'<br>';
                }

            }
        }
        Yii::$app->db->createCommand()->batchInsert('school',['name', 'city_id', 'region_id'],$data)->execute() ;
        //var_dump($data);
        die;
        // вывод страницы Яндекса в представление
        return $this->render('index', ['news' => $news]);
    }
}