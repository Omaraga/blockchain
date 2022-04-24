<?php

namespace backend\models;
use common\models\User;
use yii\helpers\ArrayHelper;

class Profile extends User
{

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(),[
            [['first_name', 'last_name', 'middle_name'], 'safe']
        ]);
    }

    public function attributeLabels()
    {
        return [
            'first_name' => \Yii::t('main', 'Имя'),
            'last_name' => \Yii::t('main', 'Фамилия'),
            'middle_name' => \Yii::t('main', 'Отчество'),
            'email' => \Yii::t('main', 'Почта'),
            'system_role' => \Yii::t('main', 'Роль'),
        ];
    }

}