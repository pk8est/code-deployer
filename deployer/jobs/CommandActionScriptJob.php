<?php
namespace deployer\jobs;

use Yii;
use Exception;
use common\models\ProjectJob;
use common\models\CommandActionScript;
use deployer\jobs\ActionScriptJob;

class CommandActionScriptJob extends BaseJob implements Job{

	private $job;
	private $action;

	public function __construct(CommandActionScript $action, ProjectJob $job = null){
		$this->job = $job;
		$this->action = $action;
	}

	public function getSign(){
		return '[job_id=' . $this->job->id . ':action_id=' . $this->action->id . ']';
	}

	public function getCategorie(){
		return 'command_action_script';
	}

	public function run(){
		try{
			$this->validation();
			Yii::info("{$this->sign}开始执行任务!", $this->categorie);
			
			(new CommandScriptJob($this->action->commandScript, $this->action, $this->job))->run();	

            Yii::info("{$this->sign}执行任务完成!", $this->categorie);

		}catch(Exception $e){
            Yii::error("{$this->sign}执行任务失败: ".$e->getMessage()."!", $this->categorie);
            throw $e;	
		}

	}

	public function validation(){
		if($this->job === null){
			throw new Exception('Attribate job is null!');
		}
	
		if($this->action === null){
			throw new Exception('Attribate action is null!');
		}
	}

}
