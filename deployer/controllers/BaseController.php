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
		return true;
	}

}
