<?php
namespace common\components;

use common\models\Server;
use Symfony\Component\Process\Process;

class Runner{

	const TEMPLATE_INPUT = true;
	const DIRECT_INPUT = true;

	private $process;
	private $script;
	private $server;
	private $runner = 'root';
	private $isLocal = true;


	public function __call($method, array $arguments = []){
        if (!is_callable([$this->process, $method])) {
            throw new \RuntimeException('Method ' . $method . ' not exists');
        }

        return call_user_func_array([$this->process, $method], $arguments);
    }

	public function __construct($script, $runner = '', $server = null){
		$this->process = new Process('');
		$this->process->setTimeout(null);
		$this->setScript($script);	
		$this->setRunner($runner);
		$this->setServer($server);
	}

	public function run($callback = null){
		$command = $this->wrapCommand($this->script);
		$this->process->setCommandLine($command);
		return $this->process->run($callback);
	}

	public function wrapCommand($script){
		return $script;
	}

	public function setScript($script){
		$this->script = $script;
	}

	public function setRunner($runner){
		if($runner){
			$this->runner = $runner;
		}
	}

	public function setServer($server){
		if($server !== null){
			$this->server = $server;
			$this->isLocal = false;
		}
	}

}
