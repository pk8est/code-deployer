<?php
namespace deployer;
use Yii;
use yii\base\Module as BaseModule;
use yii\helpers\ArrayHelper;

class Module extends BaseModule
{
    public function init()
    {
        parent::init();
		$config = ArrayHelper::merge(
			require __DIR__ . '/config/main.php',
    		require __DIR__ . '/config/main-local.php'	
		);
		
		$this->modules = ArrayHelper::getValue($config, 'modules', []);
		$this->loadComponents($config);
		Yii::configure($this, $config);
    }


	public function loadComponents(&$config){
		foreach($config as $id => $component){
			if(isset($component['class'])){
				unset($config[$id]);
			}
		}
	}
}
