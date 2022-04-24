<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property int $id
 * @property int $category
 * @property string $title
 * @property int $time
 * @property int $user_id
 * @property int $status
 * @property int $end_time
 * @property int $task_id
 */
class Tickets extends \yii\db\ActiveRecord
{
    const TYPE_EMAIL_CHANGE = 1;
    const TYPE_ERROR_TASK = 2;
    const TYPE_PAYMENT = 3;
    const TYPE_OTHER = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'title', 'time', 'user_id'], 'required'],
            [['category', 'time', 'user_id', 'status', 'end_time'], 'integer'],
            [['title'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Номер'),
            'category' => Yii::t('app', 'Категория'),
            'title' => Yii::t('app', 'Тема'),
            'time' => Yii::t('app', 'Время'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'status' => Yii::t('app', 'Статус'),
            'end_time' => Yii::t('app', 'Время закрытия'),
        ];
    }

    public static function getCategoryList(){
        return [
            self::TYPE_EMAIL_CHANGE => Yii::t('main','E-mail ауыстыру'),
            self::TYPE_ERROR_TASK => Yii::t('main', 'Тапсырмада қателік'),
            self::TYPE_PAYMENT => Yii::t('main', 'Төлемде қателік'),
            self::TYPE_OTHER => Yii::t('main', 'Басқа')
        ];
    }
}
