<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Wow Cleans',
	'theme'=>'whitelabelTheme',
	'defaultController'=>'user',
	

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
			'ipFilters' => array('127.0.0.1', $_SERVER['REMOTE_ADDR']),
		),
		//'admin',
		'admin','registration','message','payment',
		'admin'=>array('defaultController'=>'admin'),
		'registration'=>array('defaultController'=>'registration'),
		'message'=>array('defaultController'=>'message'),
		'payment'=>array('defaultController'=>'payment'),
		 
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<admin:\w+>/<controller:\w+>/<action:[0-9a-zA-Z_\-]+>/<id:\d+>' => '<admin>/<controller>/<action>',
                  '<admin:\w+>/<controller:\w+>/<action:[0-9a-zA-Z_\-]+>' => '<admin>/<controller>/<action>',
                 '<admin:\w+>/<controller:\w+>' => '<admin>/<controller>/index',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ccobs',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'password',
			'charset' => 'utf8',
			'schemaCachingDuration' => 30,
			'tablePrefix' => 'ccobs_',
			'enableParamLogging' => true,
			'class' => 'CDbConnection'
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
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

		'mailer' => array(
			'class'=>'application.components.Mailer',
			'from' => 'WowCleans <info@wowcleans.com>',
			'bcc' => array('info@wowcleans.com','devgn88@gmail.com'),
			'htmlFormat' => true,
			'disclaimer' => 
				// this should be always be declared in plain text format.
				'Email Disclaimer' . "\r\n" .
				'The information in this email is confidential and is intended solely for the addressee(s). ' . "\r\n" .
				"\r\n" . 
				'Thank You,' . "\r\n" .
				'WowCleans' . "\r\n",
		),

		'Paypal' => array(
			'class'=>'application.components.Paypal',
			'apiUsername' => 'kanavk-facilitator_api1.ocodewire.com',
			'apiPassword' => '1404460510',
			'apiSignature' => 'A4sylwT.LsGOlR5e0Qos27RoSta5AKLvXCCjXXHcGN8Tor8.JxNZxIAs',
			'apiLive' => false,
			
			'returnUrl' => 'paypal/confirm/', //regardless of url management component
			'cancelUrl' => 'paypal/cancel/', //regardless of url management component
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
