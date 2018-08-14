<?php 
namespace deployer\services;

use Yii;
use common\models\Project;
use common\models\ProjectJob;
use common\models\CommandScript;
use common\models\CommandStep;
use common\models\CommandJob;
use common\models\Server;
use common\models\CommandActionScript;
use common\components\Runner as Process;

class DeployService extends BaseService{


	public function deploy($id){
		$job = ProjectJob::find()->with('commandActionScripts.commandScript')->where(['id' => $id])->one();	
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
		foreach($job->commandActionScripts as $key => $commandActionScript){
			$this->runCommandScript($job, $commandActionScript, $commandActionScript->commandScript);
		}
	}

	public function runCommandScript(ProjectJob $job, CommandActionScript $action, CommandScript $script){
		if($job === null || $action === null || $script === null){
			throw new \Exception("job/action/script has null!");
		}
		if($script->beforeSteps){
			$this->runCommandSteps($job, $script->beforeSteps);
		}	

		if($action->is_local){
			//$this->runLocalCommandScript($job, $action, $script);
		}else{
			//$this->runRemoteCommandScipt($job, $action, $script, $job->actionServers);
		}		

		if($script->afterSteps){
			$this->runCommandStep($job, $script->afterSteps);
		}

	}

	public function runCommandSteps(ProjectJob $job, $steps){
		foreach($steps as $key => $step){
			$this->runCommandStep($job, $step);
		}
	}

	public function runCommandStep(ProjectJob $job, CommandStep $step){
		if($step->is_local){
			$this->runScript($step->script, [], $step->runner);
		}else{
			foreach($job->actionServers as $key => $server){
				$this->runScript($step->script, [], $step->runner, $server);
			}
		}
	}

	public function runScript($script, $tokens = [], $user = null, $server = null){
		$process = new Process($script, $tokens);
		if($server){
			$process->setRemote($server->ip, $server->port, $server->ssh_private_key);
		}
		if($user){
			$process->setUser($user);
		}
		$process->run();

		if($process->isSuccessful()){
			dd($process->getOutput());die;
			
		}
	}

}
