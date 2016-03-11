<?php 
use Illuminate\Database\Capsule\Manager as Capsule;
use Whoops\Run;

session_start(); // 开启session

// 定义BASE_PATH
define('BASE_PATH', __DIR__);

// CONFIG_PATH
define('CONFIG_PATH', BASE_PATH.'/config');

// LIB_PATH
define('LIB_PATH', BASE_PATH.'/lib');

// CORE_PATH
define('CORE_PATH', BASE_PATH.'/core');

// APP_PATH
define('APP_PATH', BASE_PATH.'/app');

//STORAGE_PATH
define('STORAGE_PATH', BASE_PATH.'/storage');

// HELPER_PATH
define('HELPER_PATH', BASE_PATH.'/helper');

// LANG_PATH
define('LANG_PATH', PUBLIC_PATH.'/Lang');


// load the helper files of helper folder
foreach(glob(HELPER_PATH.'/*.php') as $helper_file)
{
	require($helper_file);
}

// 载入autoload
require BASE_PATH.'/vendor/autoload.php';

$capsule = new Capsule;

$capsule->addConnection(require "../config/database.php");

$capsule->setAsGlobal();	// Make this Capsule instance available globally via static methods

$capsule->bootEloquent();	// Setup the Eloquent ORM

// whoops错误提示
if(ENV == 'development')
{
	$whoops = new Run();
	$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
	$whoops->register();
}

// add the constant file
require(CONFIG_PATH.'/constant.php');

require LIB_PATH.'/Router.php';