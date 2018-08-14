<?php 
namespace deployer\services;

use Yii;
use common\models\Project;
use common\models\ProjectJob;
use common\models\CommandScript;
use common\models\CommandStep;
use common\models\CommandJob;
use common\models\Server;

class DeployService extends BaseService{


	public function deploy($id){
		$job = ProjectJob::findOne($id);	
		if($job === null){
			throw new \Exception("Job in not found!");
		}
		try{
			Yii::info("[{$job->id}]开始执行任务!", 'deployer');
			$job->updateStatus(ProjectJob::JOB_RUN_STARTED);

			$this->runProjectJob($job);

			$job->updateStatus(ProjectJob::JOB_RUN_FINISHED);
			Yii::info("[{$job->id}]执行任务完成!", 'deployer');
			
		}catch(\Exception $e){	
			$job->updateStatus(ProjectJob::JOB_RUN_FAILED);
			Yii::error("[{$job->id}]执行任务失败: ".$e->getMessage()."!", 'deployer');
			throw $e;
		}
	}
	

	public function runProjectJob(ProjectJob $job){
		Yii::info("[{$job->id}]开始获取执行脚本!", 'deployer');	
		foreach($job->commandScripts as $key => $commandScript){
			$this->runCommandScript($job, $commandScript);
		}
	}

	public function runCommandScript(ProjectJob $job, CommandScript $script){
		if($script->beforeSteps){
			$this->runCommandSteps($job, $script->beforeSteps);
		}	
	}

	public function runCommandSteps(ProjectJob $job, $steps){
		foreach($steps as $key => $step){
			$this->runCommandStep($job, $step);
		}
	}

	public function runCommandStep(ProjectJob $job, CommandStep $step){
		if($step->is_local){
			
		}else{
			foreach($job->actionServers as $key => $server){
				dd($server);die;
			}
		}
	}

}
