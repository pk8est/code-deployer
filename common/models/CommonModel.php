<?php

namespace common\models;

use Yii;

class CommonModel extends \yii\db\ActiveRecord
{
	public function beforeSave($insert){
        if($insert){
			$this->creater_id = Yii::$app->user->id;
			$this->created_at = time();
		}
		return true;
    }
}
