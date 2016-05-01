<?php

namespace App\Controllers\Admin\User;

use App\Controllers\Admin\ABaseController;
use App\Models\User;

class UserController extends ABaseController
{

	private $User;

	public function __construct()
	{
		parent::__construct();
		$this->view = new \View();
		$this->User = new User();
	}

	public function login()
	{
		if($this->isLogin())
		{
			// header('location:/admin');
		}
		if($this->ispost())
		{
			$User = new User();
			$username = $this->p('username');
			$password = $this->p('password');
			$remember = $this->p('remember');
			try
			{
				$r = $User->auth($username, $password, $remember);	// 用户验证
				if($r)
				{
					exit(json_encode( ['code' => 1, 'url'	=> '/admin']));
				}

			}
			catch(\Exception $e)
			{
				info($e->getMessage(),-1);
			}
		}
		else
		{
			$this->view->addJs('admin/default/js/login.js');
			$this->view->show('user/login');
		}
	}


	public function createUser()
	{
		$activat = 1;
		try
		{
			$r = $this->User->createUser('aa@aa.com', '123456');	// 创建用户成功

		}
		catch(\Exception $e)	// 创建用户失败
		{
			echo $e->getMessage();
		}
	}

}
