<?php 
namespace App\Controllers;

use Core\Controllers\Controller;
use App\Models\Config;

class BaseController extends Controller
{

	/**
	 *
	 *
	 *
	 */
	public function getConfig($key)
	{
		$Config = new Config;
		return $Config->getConfig($key);

	}

	/**
	 *
	 *
	 *
	 */
	public function setConfig($key, $value)
	{
		$Config = new Config;
		$Config->setConfig($key, $value);
	}

	public function updateConfig($key, $value)
	{
		$Config = new Config;
		$Config->updateConfig($key, $value);
	}
}