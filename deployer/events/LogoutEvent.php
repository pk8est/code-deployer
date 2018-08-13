<?php
namespace deployer\events;

use yii\base\Event;

class LogoutEvent extends Event{
	const EVENT_USER_LOGOUT = 'event_user_logout';
	public $uid;
	public $username;

	public function __construct( $uid = 0, $username = ''){
		$this->uid = $uid;
		$this->username = $username;
	}


} 


