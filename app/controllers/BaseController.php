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

	public function mget($url)
	{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
 
		return $file_contents;
	}


	/***********************微信公众号相关****************/


	/**
	  * 获取appid
	  *
	  *
	  */
	public function getAppId()
	{
		return getConfig('wechat.APPID');
	}

	/**
	 * 获取secret
	 *
	 */
	public function getSecret()
	{
		return getConfig('wechat.SECRET');
	}
}