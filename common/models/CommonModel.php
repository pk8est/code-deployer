<?php

namespace common\models;

use Yii;

class CommonModel extends \yii\db\ActiveRecord
{
	const STATUS_NORMAL = 1;
	const STATUS_DISABLE = -1;

	public static function getStatusArr(){
		return [
            self::STATUS_NORMAL => ['name' => '正常', 'code' => 'info'],
            self::STATUS_DISABLE => ['name' => '停用', 'code' => 'danger'],
        ];
	}

	public function beforeSave($insert){
        if($insert){
			if($this->hasAttribute('creater_id')) $this->creater_id = Yii::$app->user->id;
			if($this->hasAttribute('created')) $this->created = time();
		}
		return true;
    }
}
