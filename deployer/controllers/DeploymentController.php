<?php
namespace deployer\controllers;

use Yii;
use yii\web\NotFountHttpException;
use common\models\Project;
use common\models\CommandAction;
use common\models\ProjectJob;
use deployer\services\DeployService;


class DeploymentController extends BaseController{
	

	public function actionDeploy($id, $action_id){
		$projectModel = Project::findOne($id);
		$commandActionModel = CommandAction::findOne($action_id);
		if($projectModel === null || $commandActionModel === null){
			throw new NotFountHttpException("project or action is null");
		}
		$projectJobModel = new ProjectJob();
		$projectJobModel->project_id = $id;
		$projectJobModel->action_id = $action_id;
		$projectJobModel->action_name = $commandActionModel->name;
		$projectJobModel->status = 0;
		$projectJobModel->save();
		$this->redirect(['deployment/deploy-job', 'id' => $projectJobModel->id]);
	}
	

	public function actionDeployJob($id){
		Yii::$app->deployer->deploy($id);
	}

}
