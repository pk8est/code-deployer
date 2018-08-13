<?php
namespace deployer\events;

use yii\base\Event;

class LoginEvent extends Event{
	public $flag;
	public $uid;
	public $username;

	public function __construct($flag, $uid = 0, $username = ''){
		$this->flag = $flag;
		$this->uid = $uid;
		$this->username = $username;
	}


} 


