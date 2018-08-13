<?php
namespace deployer\events;

use Yii;
use common\components\LogMessage;
use yii\base\Component;

class UserEventHandler extends Component{

	public function login(LoginEvent $event){
		$title = "[" . $event->username . "]登陆系统" . ($event->flag ? '成功' : '失败') . "";
		Yii::info(new LogMessage("用户登陆", $event->uid, $event::EVENT_USER_LOGIN, $title), 'common');
	}

	public function logout(LogoutEvent $event){
		
		$title = "[" . $event->username . "]退出了系统";
		Yii::info(new LogMessage("用户登出", $event->uid, $event::EVENT_USER_LOGOUT, $title), 'common');
	}

}

