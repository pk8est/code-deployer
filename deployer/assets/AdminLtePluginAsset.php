<?php
namespace deployer\assets;

use Yii;
use yii\web\AssetBundle;
class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte';
	public $baseUrl = '@web';
	//全局js  
    public $js = [
		//'dist/js/pages/dashboard.js',
		//'select2/dist/js/select2.full.min.js',
        //'datatables/dataTables.bootstrap.min.js',
        // more plugin Js here
    ];
	//全局css
    public $css = [
		//'select2/dist/css/select2.min.css',
        //'datatables/dataTables.bootstrap.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];

	public static function getDistUrl(){
		return Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
	}

	public static function getBaseUrl(){
		return Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte');

	}

	//定义按需加载JS方法，注意加载顺序在最后  
    public static function addjsFile($view, $jsfile) {  
		
        $view->registerJsFile($jsfile, ['depends' => 'deployer\assets\AppAsset']);  
    }  
      
   //定义按需加载css方法，注意加载顺序在最后  
    public static function addCss($view, $cssfile) {  
        $view->registerCssFile($cssfile, [AdminLtePluginAsset::className(), 'depends' => 'deployer\assets\AdminLtePluginAsset']);  
    } 
}
