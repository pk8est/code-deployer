<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
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
			'*',
		]
	],
    'params' => $params,
];
