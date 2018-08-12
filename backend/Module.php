<?php
namespace backend;
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
        unset($config['modules']);
        unset($config['bootstrap']);
        Yii::configure($this, $config);
    }

	public function loadComponents(&$config){
		$coreComponents = $this->module->coreComponents();
        foreach($config['components'] as $id => $component){
            if(is_array($component) && !isset($component['class']) && isset($coreComponents[$id])){
                $config['components'][$id]['class'] = $coreComponents[$id]['class'];
            }
        } 
    }
}
