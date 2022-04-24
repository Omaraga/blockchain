<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $text
 * @property int|null $ticket_id
 * @property int|null $user_id
 * @property string $link
 * @property int $time
 * @property int $is_private
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'time'], 'required'],
            [['text'], 'string'],
            [['ticket_id', 'user_id', 'time','is_private'], 'integer'],
            [['link'], 'string', 'max' => 510],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'text' => Yii::t('app', 'Text'),
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'link' => Yii::t('app', 'Link'),
            'time' => Yii::t('app', 'Time'),
        ];
    }
}
