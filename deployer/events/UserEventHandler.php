<?php
namespace deployer\events;

use Yii;
use common\components\LogMessage;
use yii\base\Component;

class UserEventHandler extends Component{

	public function login(LoginEvent $event){
		$title = "[" . $event->username . "]登陆系统" . ($event->flag ? '成功' : '失败');
		Yii::info(new LogMessage("用户登陆", $event->uid, Events::EVENT_USER_LOGIN, $title), 'common');
	}

	public function logout(LogoutEvent $event){
		
		$title = "[" . $event->username . "]退出了系统";
		Yii::info(new LogMessage("用户登出", $event->uid, Events::EVENT_USER_LOGOUT, $title), 'common');
	}

	public function beforeAction($event){
		if(Yii::$app->request->isGet || Yii::$app->request->isHead){
			return true;
		}
		switch($event->action->id){
			case 'create':
				$action = "创建";
				break;
			case 'update':
				$action = "更新";
				break;
			case 'delete':
				$action = '删除';
				break;
			case 'index':
				$action = '列表';
				break;
			case 'view':
				$action = '查看';
				break;
			case 'login':
			case 'logout':
				return true;
			default:
				$action = $event->action->id;
		}
		$controller = Yii::$app->controller->id;
		$title = "[".Yii::$app->user->identity->username."]执行[{$controller}:{$action}]操作";
		Yii::info(new LogMessage([
			'controller' => $controller,
			'action' => $event->action->id,
			'title' => $title,
			'GET' => Yii::$app->request->get(),
			'POST' => Yii::$app->request->post(),
		], Yii::$app->user->id, Events::EVENT_ACTION_BEFORE, $title), 'common');
		return true;
	} 

}

