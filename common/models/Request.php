<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int|null $good_id
 * @property int|null $user_id
 * @property int|null $author_id
 * @property string|null $code
 * @property int|null $status
 */
class Request extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_SEND = 1;
    const STATUS_DECLINE = 2;
    const STATUS_ACCEPT = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['good_id', 'user_id', 'author_id', 'status'], 'integer'],
            [['code'], 'string', 'max' => 255],
        ];
    }

    public static function getStatusList(){
        return [
            self::STATUS_NEW => 'Жаңа',
            self::STATUS_SEND => 'Жауап күтілуде',
            self::STATUS_DECLINE => 'Бас тартты',
            self::STATUS_ACCEPT => 'Рұқсат берілді',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'good_id' => 'Жұмыс',
            'user_id' => 'Қолданушы',
            'author_id' => 'Автор',
            'code' => 'Block chain',
            'status' => 'Статус',
        ];
    }
}
