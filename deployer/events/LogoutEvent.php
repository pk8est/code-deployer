<?php
namespace deployer\events;

use yii\base\Event;

class LogoutEvent extends Event{
	public $uid;
	public $username;

	public function __construct( $uid = 0, $username = ''){
		$this->uid = $uid;
		$this->username = $username;
	}


} 


