<?php

namespace deployer\controllers;

use Yii;
use yii\web\Controller;
use common\components\LogMessage;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class BaseController extends Controller
{
	
	public function init(){
		parent::init();
		
	}

	public function beforeAction($action){
		if(!parent::beforeAction($action)){
			return false;
		}
		//dd($action);die;
		//Yii::info(new LogMessage('进入列表操作', Yii::$app->user->id, 'project/index', '进入项目列表'), 'app');
		return true;
	}

}
