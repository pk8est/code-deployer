<?php
namespace deployer\controllers;

use Yii;
use yii\web\NotFountHttpException;
use common\models\Project;
use common\models\CommandAction;
use common\models\ProjectJob;
use deployer\services\DeployService;
use deployer\jobs\DeployJob;

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
		$job = new DeployJob($projectJobModel);
		try{
        	$job->run();
		}catch(\Exception $e){}
	
		return $this->render('deploy', [
			'model' => $projectJobModel,
		]);
		
	}

	public function actionDetail($id){
		return $this->render('deploy', [
			'model' => ProjectJob::findOne($id)
		]);
	}
	

	public function actionDeployJob($id){
		try{
			$job = new DeployJob(ProjectJob::find()->with('commandActionScripts.commandScript')->where(['id' => $id])->one());
			$job->run();
		}catch(\Exception $e){}
		return $this->render('deploy', [
            'model' => ProjectJob::findOne($id)
        ]);
	}

}
