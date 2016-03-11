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


}