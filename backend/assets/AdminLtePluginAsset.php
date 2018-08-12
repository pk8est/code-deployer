<?php
namespace backend\assets;

use yii\web\AssetBundle;
class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/bower_components';
    public $js = [
		//'select2/dist/js/select2.full.min.js',
        //'datatables/dataTables.bootstrap.min.js',
        // more plugin Js here
    ];
    public $css = [
		//'select2/dist/css/select2.min.css',
        //'datatables/dataTables.bootstrap.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}
