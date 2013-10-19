<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    
    'language'=> 'ru',
    
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array(
        'config',
        'log',
    ),

	// autoloading model and component classes
	'import'=>array(
		'application.components.*',
        'application.helpers.*',
		'application.models.*',
        'application.extensions.tinymce.*',
        'application.extensions.elFinder.*',
	),

    'theme'=>'sfbonus',
    
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
		),
        'admin' => array(
            'preload'=>array('bootstrap'),
            'components'=>array(
                'bootstrap'=>array(
                    'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
                ),
            ),
        ),
	),

	// application components
	'components'=>array(
        'authManager'=>array(
            'class'=>'PhpAuthManager',
            'defaultRoles' => array('guest'),
        ),
		'cache'=>array(
			'class'=>'CFileCache',
		),
        'clientScript'=>array(
            'coreScriptPosition' => CClientScript::POS_END,
        ),
        'config'=>array(
            'class'=>'application.components.CConfig',
        ),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=sfbonus_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
            'tablePrefix' => 'bkz_'
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        'file'=>array(
            'class'=>'application.extensions.file.CFile',
        ),
        'html' => array(
            'class' => 'Html',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
        'request'=>array(
            'class' => 'application.components.HttpRequest',
            'enableCsrfValidation'=>true,
            'enableCookieValidation'=>true,
        ),
        'session'=>array(
            'timeout' => 1440,
        ),
		'urlManager'=>array(
			'urlFormat'=>'path',
            'urlSuffix'=>'.html',
            'showScriptName'=>false,
			'rules'=>array(
                'news'=>'news/index',
                '<module:\w+>'=>'<module>/default/index',
				'<module:\w+>/<controller:\w+>'=>'<module>/<controller>/index',
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                '<alias:[\w_\/-]+>'=>'site/page',
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'user'=>array(
            'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>false,
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'admin@sfbonus.loc',
        'uploadDir'=>DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR,
        'uploadDirURL'=>'/upload/',
	),
);