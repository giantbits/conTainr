<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/config.php';

// disable in production mode
error_reporting(1);
error_reporting(E_ALL);


defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',2);


require_once($yii);
Yii::createWebApplication($config)->run();
