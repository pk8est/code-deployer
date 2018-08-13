<?php
namespace common\components;

class LogMessage{
	public $uid;
	public $type;
	public $title;
	public $message;

	public function __construct($message, $uid = 0, $type = '', $title = ''){
		$this->uid = $uid;
		$this->type = $type;
		$this->title = $title;
		$this->message = $message;
	}
	
}
