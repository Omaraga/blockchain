<?php

namespace common\models;

use backend\models\BackendHelper;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $logo
 * @property string|null $phones
 * @property string|null $address
 * @property string|null $url
 */
class Settings extends \yii\db\ActiveRecord
{
    public $image;
    public $phoneList;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phones'], 'string'],
            [['phoneList'], 'safe'],
            [['image'], 'file','extensions' => ['png', 'jpg', 'gif', 'PNG', 'JPG', 'GIF', 'JPEG', 'jpeg'],],
            [['name', 'logo', 'address', 'url'], 'string', 'max' => 255],
        ];
    }

    public function loadDefaultValues($skipIfSet = true)
    {
        $this->phoneList = isset($this->phones) ? json_decode($this->phones): [''];
        if (!$this->url){
            $this->url = BackendHelper::getUrl();
        }
        return parent::loadDefaultValues($skipIfSet); // TODO: Change the autogenerated stub
    }



    /**
     * @param UploadedFile $file
     */
    private function saveFile(UploadedFile $file){
        $link = ($this->logo) ? : null;
        $this->image = $file;
        if ($this->validate(['file'])) {
            $rand = uniqid(rand(), true);
            $dir = Yii::getAlias('@frontend/web/docs/settings/');
            $dir2 = Yii::getAlias('docs/settings/');
            $fileName = $rand . '.' . $this->image->extension;
            $this->image->saveAs($dir . $fileName);
            $this->image = $fileName; // без этого ошибка
            $link = '/'.$dir2 . $fileName;
        }

        $this->logo = $link;
        $this->image = null;
    }

    /**
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        $file = UploadedFile::getInstance($this, "image");
        if ($file && $file->tempName) {
            $this->saveFile($file);
        }
        if ($this->phoneList) {
            $this->phones = json_encode($this->phoneList);
        }
        return parent::save($runValidation, $attributeNames); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Название компании'),
            'image' => Yii::t('app', 'Логотип'),
            'logo' => Yii::t('app', 'Логотип'),
            'phones' => Yii::t('app', 'Телефоны'),
            'address' => Yii::t('app', 'Адрес'),
            'url' => Yii::t('app', 'Url сайта'),
        ];
    }
}
