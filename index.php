<?php

$yii = __DIR__ . '/../yii/framework/yii.php';
$config = __DIR__ . '/protected/config/main.php';

// Remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// Specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
