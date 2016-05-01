<?php
namespace App\Models;

use Core\Orms\Orm;
use Illuminate\Database\Capsule\Manager as DB;

class User extends Orm
{

  	public $timestamps = false;

  	/**
  	 *	用户登录
  	 *
  	 *
  	 */
  	public function auth($username, $password, $remember)
  	{
  		if(!$username || !$password)
  		{
  			// return array('code' => -1, 'info' => \Lang::get('user.USERNAME_PASSWORD_CANNOT_NULL'));
  			throw new \Exception(\Lang::get('user.USERNAME_PASSWORD_CANNOT_NULL'));
  		}
  		$password = $this->mixture($password);
  		$user = DB::select('SELECT * FROM `users` WHERE `email` = ? AND `password` = ? LIMIT 1', array($username, $password));
  		if($user)
  		{
  			$_SESSION['uid'] = $user[0]->id;
  			unset($user[0]->password);
  			$user = $user[0];
  			return $user;
  		}
  		else
  		{
  			// return array('code'=>-2, 'info'	=> \Lang::get('user.USERNAME_AND_PASSWORD_NOT_MATCH'));
  			throw new \Exception(\Lang::get('user.USERNAME_AND_PASSWORD_NOT_MATCH'));
  		}
  	}

  	/**
  	 *	添加用户
  	 *
  	 *
  	 */
  	public function createUser($username, $password, $activated=0)
  	{
  		$password = $this->mixture($password);
  		$isExist = DB::select('SELECT * FROM `users` WHERE `email` = ? ORDER BY id asc ',array($username));
  		if(count($isExist))
  		{
  			throw new \Exception(\Lang::get('user.USER_ALREADY_EXISTS'));
  			// return info(\Lang::get('user.USER_ALREADY_EXISTS'),-1, 'array');
  		}
  		DB::insert('INSERT INTO `users` (`email`,`password`,`activated`) VALUES (?,?,?)',array($username, $password, $activated));
  		return 1;	// 添加成功
  	}

  	public function logout()
  	{

  	}

  	private function mixture($str)
  	{
  		$str = md5(trim($str).getConfig('common.mixkey'));
  		return $str;
  	}

}