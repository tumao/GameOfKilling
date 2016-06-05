<?php
namespace Core\Controllers;

class Controller
{

	public $view;

	public function __construct()
	{
		$this->view = new \View();	
	}

	protected function loadViewer ()
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
	 * 判断请求方法
	 * 
	 * */
	protected function method ()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$method = strtoupper ($method);
		return $method;
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
	protected function get_config($key)
	{
		$Config = new Config;
		return $Config->getConfig($key);

	}

	/**
	 *
	 *
	 *
	 */
	protected function set_config($key, $value)
	{
		$Config = new Config;
		$Config->setConfig($key, $value);
	}

	protected function update_config($key, $value)
	{
		$Config = new Config;
		$Config->updateConfig($key, $value);
	}

	// GET请求
	protected function sent_get($url)
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

	// xml POST请求
	protected function sent_post($url, $para, $certArr=array())
	{
		$curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//SSL证书认证
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);//严格认证
		curl_setopt($curl, CURLOPT_VERBOSE, 1); //debug模式
		if(!empty($certArr))
		{
			curl_setopt($curl, CURLOPT_SSLCERT, $certArr['cert']);
			curl_setopt($curl, CURLOPT_SSLKEY, $certArr['key']);
			curl_setopt($curl, CURLOPT_CAINFO, $certArr['rootca']);
			//curl_setopt($curl, CURLOPT_SSLKEYPASSWD, 'c23b76fe5a1c7befb230debe7cdcdc83');
		}
		curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
		curl_setopt($curl,CURLOPT_POST,true); // post传输数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,$para);// post传输数据
		$responseText = curl_exec($curl);

		curl_close($curl);
		return $responseText;
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
	protected function getsec()
	{
		return getConfig('wechat.SECRET');
	}

	/**
	 *	获取token
	 * 	 @param boolean $new_token 清楚缓存中的token重新获取token,并且缓存
	 */
	protected function get_token($new_token = False)
	{
		$appid = $this->getaid();
		$secret = $this->getsec();

		if($token = \iRedis::get('token') && !$new_token)
		{
			return $token;
		}
		else
		{
			$result = $this->sent_get("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}");	// 获取的数据为json格式
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
	protected function clear_token()
	{
		\iRedis::delete('token');
	}


	/**
	 *	获取用户的 openid ---todo
	 *
	 *
	 */
	protected function get_openid()
	{
		if (isset($_SESSION['openid']))		
		{
			return $_SESSION['openid'];
		}
		return null;
	}
}