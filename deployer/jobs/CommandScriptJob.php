<?php
namespace deployer\jobs;

use Yii;
use Exception;
use common\models\Project;
use common\models\ProjectJob;
use common\models\CommandScript;
use common\models\CommandStep;
use common\models\CommandJob;
use common\models\CommandLog;
use common\models\Server;
use common\models\CommandActionScript;
use common\components\Parser;
use deployer\jobs\CommandStepJob;

class CommandScriptJob extends BaseJob implements Job{

	private $job;
	private $action;
	private $script;

	public function __construct(CommandScript $script, CommandActionScript $action, ProjectJob $job = null){
		$this->job = $job;
		$this->action = $action;
		$this->script = $script;
	}

	public function getSign(){
		return '[job_id=' . $this->job->id . ':action_id=' . $this->action->id . ':script_id=' . $this->script->id . ']';
	}

	public function getCategorie(){
		return 'command_script';
	}

	public function run(){
		try{
			$this->validation();
			Yii::info("{$this->sign}开始执行任务!", $this->categorie);
			
			if($this->script->beforeSteps){
            	$this->runSteps($this->script->beforeSteps);
        	}

			$script = Parser::parseString($this->script->scriptUnix, $this->job->variableArray);
			if($this->action->is_local){
				$this->runProcess($script);
			}else{
				foreach($this->job->activeActionServers as $server){
					$this->runProcess($script, $server);
				}
			}

			if($this->script->afterSteps){
				$this->runSteps($this->script->afterSteps);
			}

            Yii::info("{$this->sign}执行任务完成!", $this->categorie);

		}catch(Exception $e){
            Yii::error("{$this->sign}执行任务失败: ".$e->getMessage()."!", $this->categorie);
            throw $e;	
		}

	}

	public function runProcess($script, $server = null){
		
		$commandJob = CommandJob::build($this->job, $this->script, null);
		$commandJob->runner = $this->script->runner;
		$commandJob->script = $script;
		(new ProcessJob($this->job, $commandJob, $server))->run();
	}

	public function runSteps(Array $steps){
		foreach($steps as $step){
			(new CommandStepJob($step, $this->script, $this->action, $this->job))->run();
		}
	}

	public function validation(){
		if($this->job === null){
			throw new Exception('Attribate job is null!');
		}
	
		if($this->action === null){
			throw new Exception('Attribate action is null!');
		}
		
		if($this->script === null){
			throw new Exception('Attribate script is null!');
		}
	}

}
