<?php
namespace deployer\events;

use yii\base\Event;

class LoginEvent extends Event{
	const EVENT_USER_LOGIN = 'event_user_login';
	public $flag;
	public $uid;
	public $username;

	public function __construct($flag, $uid = 0, $username = ''){
		$this->flag = $flag;
		$this->uid = $uid;
		$this->username = $username;
	}


} 


