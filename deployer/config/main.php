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
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
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
		'assetManager' => [
      		'bundles' => [
            	'dmstr\web\AdminLteAsset' => [
                	'skin' => 'skin-blue',
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
        
    ],
	'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
			'site/*'
			//'*',
		]
	],
	'container' => [
        'definitions' => [
            'yii\grid\GridView' => [
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered'
                ],
                'summary'   => '<div class="pull-left">共{totalCount}条记录，每页{pageCount}条</div>',
                'layout' => "{summary}\n{items}\n{pager}",
            ],
            'yii\widgets\LinkPager' => [
                //'p;revPageLabel' => '',
                //'nextPageLabel' => '->',
                'firstPageLabel' => '首页', 
                'lastPageLabel' => '尾页', 
            ],
            'yii\grid\ActionColumn' => [
                'header' => '操作',
                'headerOptions'=> ['width'=> '190'],
                //'template' => '<div class="btn-group">'.Helper::filterActionColumn('{view}{update}{delete}').'</div>',
                'template' => '<div class="btn-group">{view}{update}{delete}</div>',
                "buttons" => [
                    "view" => function ($url){
                        return Html::a(Yii::t('app', 'view'), $url, ['class' => 'btn btn-sm btn-success']);
                    },
                    "update" => function ($url){
                        $options = [
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => 'btn btn-sm btn-info'
                        ];
                        return Html::a(Yii::t('app', 'update'), $url, $options);
                    },
                    "delete" => function ($url){
                        $options = [
                            'aria-label' => Yii::t('app', 'delete'),
                            'data-confirm' => '确认删除该记录?',
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => 'btn btn-sm btn-danger'
                        ];
                        return Html::a(Yii::t('app', 'delete'), $url, $options);
                    }
                ]
            ],
        ],
    ],
    'params' => $params,
];
