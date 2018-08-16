<?php
namespace deployer\jobs;

use Yii;
use Exception;
use common\models\ProjectJob;
use common\models\CommandJob;
use common\models\Server;
use common\components\Runner as Process;

class ProcessJob extends BaseJob  implements Job{

	private $job;
	private $commandJob;
	private $server;	

	public function __construct(ProjectJob $job, CommandJob $commandJob, Server $server = null){
		$this->job = $job;
		$this->commandJob = $commandJob;
		$this->server = $server;
	}

	public function getSign(){
		return '[job_id=' . $this->job->id . ']';
	}

	public function getCategorie(){
		return 'process_job';
	}

	public function run(){
		try{
			$this->validation();
			Yii::info("{$this->sign}开始执行任务!", $this->categorie);
			
			$process = new Process($this->commandJob->script, $this->commandJob->runner, $this->server);
			
			$this->commandJob->server_ip = $this->server ? $this->server->ip : '';
        	$process->run();
            if($process->isSuccessful()){
				$this->commandJob->status = CommandJob::COMMAND_JOB_RUN_FINISHED;
				$this->commandJob->messages = $process->getOutput();
			}else{
				$this->commandJob->status = CommandJob::COMMAND_JOB_RUN_FAILED;
				$this->commandJob->messages = $process->getErrorOutput();
				if(!$this->commandJob->optional){
					throw new Exception($this->commandJob->messages);
				}
			}
			Yii::info("{$this->sign}执行任务完成!", $this->categorie);

		}catch(Exception $e){
            Yii::error("{$this->sign}执行任务失败: ".$e->getMessage()."!", $this->categorie);
		    $this->commandJob->status = CommandJob::COMMAND_JOB_RUN_FAILED;	
            throw $e;	
		}finally{
			$this->commandJob->finished_at = time();
			$this->commandJob->save();
		}
		
	}
	
	public function validation(){
		if($this->job === null){
			throw new Exception('Attribute job is null!');
		}

		if($this->commandJob === null){
			throw new Exception('Attribute commandJob is null!');
		}
	}
}
