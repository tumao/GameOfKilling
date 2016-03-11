<?php
use NoahBuscher\Macaw\Macaw;

class Route extends Macaw
{

}

include(CONFIG_PATH.'/routes.php');

Route::$error_callback = function()
{
	throw new Exception('404 PAGE NOT FOUND');
};

Route::dispatch();	// 执行routes