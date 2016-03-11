<?php
namespace Core\Controllers;

class Controller
{

	public $view;

	public function __construct()
	{
		$this->view = new \View();
	}

	// judge the method
	protected function ispost()
	{
		if(strtolower($_SERVER['REQUEST_METHOD']) == 'post')
		{
			return true;
		}
		return false;
	}

	// receive post data and filt
	protected function p($key, $filter = FILTER_ALL)
	{
		if(!isset($_POST[$key]))
		{
			return false;
		}
		return parseDataByFilter($_POST[$key], $filter);
	}

	// get
	protected function g($key, $filter = FILTER_ALL)
	{
		if(!isset($_GET[$key]))
		{
			return false;
		}

		return parseDataByFilter($_GET[$key], $filter);
	}

	// request
	protected function r($key, $filter = FILTER_ALL)
	{
		if(!isset($_REQUEST[$key]))
		{
			return false;
		}

		return parseDataByFilter($_REQUEST[$key], $filter);
	}

	/**
	 *	获取当前登陆用户的id
	 *
	 *
	 */
	protected function getUserId()
	{
		if(!isset($_SESSION['uid']))
		{
			return 0;	// 未找到
		}

		return $_SESSION['uid'];
	}

	/**
	 *	判断当前用户是否登陆
	 *
	 *
	 */
	protected function isLogin()
	{
		if(isset($_SESSION['uid']))	// 已经登陆
		{
			return 1;
		}
		else
		{
			return 0;	// 未登录
		}
	}

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

	public function sentGet($url)
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
	protected function getaid()
	{
		return getConfig('wechat.APPID');
	}

	/**
	 * 获取secret
	 *
	 */
	public function getsec()
	{
		return getConfig('wechat.SECRET');
	}

	/**
	 *	获取token
	 *
	 */
	public function getToken()
	{
		$appid = $this->getaid();
		$secret = $this->getsec();
		
		if($token = \iRedis::get('token'))
		{
			return $token;
		}
		else
		{
			$result = $this->sentGet("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}");	// 获取的数据为json格式

			$result = json_decode($result);
			$token = $result->access_token;
			if($token)	// 将获取到的token存入redis
			{
				\iRedis::set('token',$token,$result->expires_in, 's');
			}

			return $token;
		}
	}

	/**
	 *	清除token
	 *
	 */
	public function clearToken()
	{
		\iRedis::delete('token');
	}

}