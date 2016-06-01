<?php
//定义PUBLIC_PATH
define('PUBLIC_PATH', __DIR__);

/**
 *	1、development
 *	2、production
 */
define('ENV', 'development');

/**
 * 	载入bootstrap
 */
require PUBLIC_PATH."/../bootstrap.php";
