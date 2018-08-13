<?php
/**
 * 公共方法
 *
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;


if(!function_exists('e')){
	function e($content){
		return Html::encode($content);
	}
}

if(!function_exists('dd')){
	function dd($var, $depth = 10, $highLight = true){
		return VarDumper::dump($var, $depth, $highLight);	
	}
}

if(!function_exists('to_route')){
    function to_route($route, $scheme = false){
        return Url::toRoute($route, $scheme);
    }
}

if(!function_exists('to_url')){
    function to_url($url = '', $scheme = false){
        return Url::to($url, $scheme);
    }
}

