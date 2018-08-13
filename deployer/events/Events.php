<?php
namespace deployer\events;

use yii\helpers\ArrayHelper;

class Events{

	const EVENT_USER_LOGIN = 'event_user_login';
	const EVENT_USER_LOGOUT = 'event_user_logout';	
	const EVENT_ACTION_BEFORE = 'event_action_before';

	public static $events = [
		self::EVENT_USER_LOGIN => ['desc' => '用户登陆', 'code' => 'info'],
		self::EVENT_USER_LOGOUT => ['desc' => '用户登出', 'code' => 'danger'],
		self::EVENT_ACTION_BEFORE => ['desc' => '用户操作', 'code' => 'success'],
	];

	public static function get($code, $key = null){
		if($key){
			return ArrayHelper::getValue(self::$events, $code . '.' . $key);
		}else{
			return ArrayHelper::getValue(self::$events, $code);
		}
	}
	
	public static function getAll(){
		return self::$events;
	}

}

