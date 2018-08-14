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
	private $ip;
	private $port;
	private $privateKey;
	private $user;
	private $isLocal;


	public function __call($method, array $arguments = []){
        if (!is_callable([$this->process, $method])) {
            throw new \RuntimeException('Method ' . $method . ' not exists');
        }

        return call_user_func_array([$this->process, $method], $arguments);
    }

	public function __construct($input, array $tokens = [], $scriptSource = self::DIRECT_INPUT){
		$this->process = new Process('');
		$this->process->setTimeout(null);
		
		if($script_source === true){
			$this->script = Parser::parseFile($input, $tokens);
		}else{
			$this->script = Parser::parseString($input, $tokens);
		}	
	}

	public function run($callback = null){
		$command = $this->wrapCommand($this->script);
		$this->process->setCommandLine($command);
		return $this->process->run($callback);
	}

	public function wrapCommand($script){
		return $script;
	}

	public function setRemote($ip, $port, $privateKey){
		$this->ip = $ip;
		$this->port = $port;
		$this->privateKey = $privateKey;
		$this->isLocal = false;
		return $this;
	}

	public function setUser($user){
		$this->user = $user;
	}

}
