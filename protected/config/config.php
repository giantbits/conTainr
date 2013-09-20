<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../modules/containr/extensions/bootstrap');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'conTainr | To begin with',
	'theme'=>'containr',
	'theme'=>'tobeginwith',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap'
	),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.containr.components.*',
		'application.modules.containr.models.*',
		'application.modules.containr.extensions.yii-mail.*',
	),

	'aliases' => array(
	    'xupload' => 'application.modules.containr.extensions.xupload',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'___',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			 'generatorPaths'=>array(
             	'bootstrap.gii',
        	),
		),
		*/
		'containr'
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'class'=>'application.modules.containr.components.ContainrUrlManager',
			'cookieDays'=>10,
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive' => false,
			'appendParams' => false,
			'rules'=>array(
				//'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				//'containr/<controller:\w+>/<action:\w+>'=>'containr/<controller>/<action>',
				//'containr/<module:\w+>/<controller:\w+>/<action:\w+>'=>'containr/<module:\w+>/<controller:\w+>/<action:\w+>',
				//'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				//'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'bootstrap' => array(
		    'class' => 'bootstrap.components.Bootstrap',
		    'responsiveCss' => true,
		    'fontAwesomeCss' => true
		),

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=XXX',
			'emulatePrepare' => true,
			'username' => 'XXX',
			'password' => 'XXX',
			'charset' => 'XXX'
			'charset' => 'utf8'
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'application.modules.containr.extensions.loganalyzer.LALogRoute',
            		'levels'=>'info, error, warning'
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'mail' => array(
			'class' => 'YiiMail',
			/*
			'transportType' => 'smtp',
			'transportOptions' => array(
				'host'=>'smtp.gmail.com',
				'username'=>'********',
				'password'=>'********',
				'port'=>'587',
				'encryption'=>'tls'
			),
			*/
		    'viewPath' => 'application.views.mail',
		    'logging' => true,
		    'dryRun' => false
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'steffen.gudis@gmail.com',
		'containrVersion'=>'V 1.0.1 Rev.159',
		'languages'=>array('en'=>'English','de'=>'Deutsch'),
		'defaultLanguage'=>'en'
	),
);
