<?php
namespace deployer\jobs;

use Yii;
use Exception;
use common\models\Project;
use common\models\ProjectJob;
use common\models\CommandScript;
use common\models\CommandStep;
use common\models\CommandJob;
use common\models\Server;
use common\models\CommandActionScript;
use common\components\Parser;

class CommandStepJob extends BaseJob implements Job{

	private $job;
	private $action;
	private $script;
	private $step;

	public function __construct(CommandStep $step, CommandScript $script, CommandActionScript $action, ProjectJob $job = null){
		$this->job = $job;
		$this->action = $action;
		$this->script = $script;
		$this->step = $step;
	}

	public function getSign(){
		return '[job_id=' . $this->job->id . ':action_id=' . $this->action->id . ':script_id=' . $this->script->id . ':step_id=' . $this->step->id  . ']';
	}

	public function getCategorie(){
		return 'command_step';
	}

	public function run(){
		try{
			$this->validation();
			Yii::info("{$this->sign}开始执行任务!", $this->categorie);
			$script = Parser::parseString($this->step->script, $this->job->variableArray);
			if($step->is_local){
				$this->runProcess($script);
			}else{
				foreach($this->job->activeActionServers as $server){
					$this->runProcess($script, $server);
				}
			}
			
            Yii::info("{$this->sign}执行任务完成!", $this->categorie);

		}catch(Exception $e){
            Yii::error("{$this->sign}执行任务失败: ".$e->getMessage()."!", $this->categorie);
            throw $e;	
		}

	}

	public function runProcess($script, $server = null){

		$commandJob = CommandJob::build($this->job, $this->script, $this->step);
		$commandJob->runner = $this->step->runner;
		$commandJob->script = $script;
		$commandJob->optional = $this->step->optional;
		(new ProcessJob($this->job, $commandJob, $server))->run();
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

		if($this->step === null){
			throw new Exception('Attribate step is null!');
		}
	}

}
