<?php
namespace deployer\jobs;

use Yii;
use Exception;
use common\models\ProjectJob;
use deployer\jobs\CommandActionScriptJob;

class DeployJob extends BaseJob implements Job{

	private $job;

	public function __construct(ProjectJob $job){
		$this->job = $job;
	}

	public function getSign(){
		return '[job_id=' . $this->job->id . ']';
	}

	public function getCategorie(){
		return 'deploy';
	}

	public function run(){
		try{
			$this->validation();
			Yii::info("{$this->sign}开始执行任务!", $this->categorie);
            $this->job->updateStatus(ProjectJob::JOB_RUN_STARTED);

            foreach($this->job->commandActionScripts as $key => $commandActionScript){
				(new CommandActionScriptJob($commandActionScript, $this->job))->run();
			}

            $this->job->updateStatus(ProjectJob::JOB_RUN_FINISHED);
            Yii::info("{$this->sign}执行任务完成!", $this->categorie);

		}catch(Exception $e){
			$this->job->updateStatus(ProjectJob::JOB_RUN_FAILED);
            Yii::error("{$this->sign}执行任务失败: ".$e->getMessage()."!", $this->categorie);
            throw $e;	
		}

	}

	public function validation(){
		if($this->job === null){
			throw new Exception('Attribate job is null!');
		}
	}

}
