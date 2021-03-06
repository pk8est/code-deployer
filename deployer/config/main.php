<?php

use yii\helpers\Html;
use mdm\admin\components\Helper;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-deployer',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'deployer\controllers',
	'defaultRoute' => 'project',
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'bootstrap' => ['log'],
    'modules' => [
		'admin' => [
			'class' => 'mdm\admin\Module',
			//'layout' => 'left-menu',
			//'mainLayout' => '@app/views/layouts/main.php',
		],
	],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-deployer',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-deployer', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            //'traceLevel' => YII_DEBUG ? 3 : 0,
			'traceLevel' => 0, 
            'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning', 'info'],
					'logVars' => ['_GET', '_POST'],
					//'categories' => ['application'],
					'logFile' => '@runtime/logs/app.log',
					//'maxFileSize' => 1024 * 100,  //设置文件大小，以k为单位
				],
				[
					'class' => 'common\components\DbTargetLog',
					'categories' => ['app', 'deployer', 'common'],
					'logTable' => 'cd_admin_log',
					'logVars' => ['*'], //只记录message
            		'levels' => ['error', 'warning', 'info'],
        		],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ], 
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
		'i18n' => [
			'translations' => [
				'rbac-admin' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@vendor/mdmsoft/yii2-admin/messages'
				],
			],
		],
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd HH:mm:ss',
            'timeFormat' => 'HH:mm:ss',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss'
       ],
		'assetManager' => [
      		'bundles' => [
            	'dmstr\web\AdminLteAsset' => [
					//'skin' => 'skin-blue',
					//'skin' => 'skin-black',
					//'skin' => 'skin-red',
					//'skin' => 'skin-yellow',
					//'skin' => 'skin-purple',
					//'skin' => 'skin-green',
					//'skin' => 'skin-blue-light',
					//'skin' => 'skin-black-light',
					//'skin' => 'skin-red-light',
					//'skin' => 'skin-yellow-light',
					//'skin' => 'skin-purple-light',
					//'skin' => 'skin-green-light',
            	],
        	],
    	],
		'deployer' => [
			'class' => 'deployer\services\DeployService'
		],
        
    ],
	'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
			'site/*'
			//'*',
		]
	],
	//'on beforeRequest' => function($event) {
        //\yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_UPDATE, ['backend\components\AdminLog', 'write']);
    //},
	'on beforeAction' => ['deployer\events\UserEventHandler', 'beforeAction'],
	'container' => [
        'definitions' => [
            'yii\grid\GridView' => [
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered'
                ],
                'summary'   => '<div class="pull-right">共{totalCount}条记录，每页{pageCount}条</div>',
                'layout' => "{items}\n{pager}\n{summary}",
            ],
            'yii\widgets\LinkPager' => [
                //'p;revPageLabel' => '',
                //'nextPageLabel' => '->',
                'firstPageLabel' => '首页', 
                'lastPageLabel' => '尾页', 
            ],
            /*'yii\widgets\ActiveForm' => [
                'options' => [
                    'class' => 'form-horizontal',
                ],
            ],
            'yii\widgets\ActiveField' => [
                'template' => "{label}\n<div class=\"col-sm-9\">{input}</div>\n{hint}\n{error}",
                'labelOptions' => [
                    'class' => 'col-sm-3 control-label',
                ],
            ],*/
            'yii\grid\ActionColumn' => [
                'header' => '操作',
                'headerOptions'=> ['width'=> '190'],
                //'template' => '<div class="btn-group">'.Helper::filterActionColumn('{view}{update}{delete}').'</div>',
                'template' => '<div class="btn-group">{view}{update}{delete}</div>',
                "buttons" => [
                    "view" => function ($url){
                        return Html::a(Yii::t('app', 'View'), $url, ['class' => 'btn btn-sm btn-success']);
                    },
                    "update" => function ($url){
                        $options = [
                            'data-method' => 'post',
                            'data-pjax' => '1',
                            'class' => 'btn btn-sm btn-info'
                        ];
                        return Html::a(Yii::t('app', 'Update'), $url, $options);
                    },
                    "delete" => function ($url){
                        $options = [
                            'aria-label' => Yii::t('app', 'delete'),
                            'data-confirm' => '确认删除该记录?',
                            'data-method' => 'post',
                            'data-pjax' => '1',
                            'class' => 'btn btn-sm btn-danger'
                        ];
                        return Html::a(Yii::t('app', 'Delete'), $url, $options);
                    }
                ]
            ],
        ],
    ],
    'params' => $params,
];
