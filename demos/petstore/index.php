<?php
//应用目录
$rootDir =  dirname(__FILE__);
$appDir = '/';

@ini_set('display_errors', '1');
error_reporting(E_ALL);

//启动MVC
include dirname(dirname($rootDir)) . '/zc-framework/zc.php';
Zc::init($rootDir, $appDir);
Zc::runMVC();