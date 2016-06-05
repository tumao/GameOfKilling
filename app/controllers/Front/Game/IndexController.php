<?php
namespace App\Controllers\Front\Game;

use App\Controllers\BaseController;
use App\Models\Game;
use App\Models\Weixin;

class IndexController extends BaseController
{
	public function index ()
	{
		$this->get_openid ();
		$this->view->addJs ('admin/default/js/gamechat.js');
		// $this->view->show ('game/index');
	}

	/**
	 * 开局,创建房间
	 * 
	 * */
	public function opening ()
	{
		if ($this->method () == 'GET')
		{
			$this -> view -> addTitle ('创建游戏');
			$this -> view ->addCss ('front/css/game.css');
			$this -> view ->addJs ('front/js/game.js');
			
			$this -> view -> show ('game/index');
		}
		else
		{
			$killer = $_POST['killer'];
			$commoner = $_POST['commoner'];
			$police = $_POST['police'];
		}
	}

	/**
	 * 进入游戏
	 * 
	 * */
	public function entering ()
	{
		$this -> view -> show ('game/entering');
	}

	/**
	 * 房间列表
	 * 
	 * */
	public function roomList ()
	{
		$Weixin = new Weixin();
		$access_token = $this->get_token ();
		$open_id = $this -> get_openid ();
		$appid = getConfig('wechat.APPID');
		$redirectUrl = urlencode('http://socketio.cn/getwxinfo');

		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}
			&redirect_uri={$redirectUrl}
			&response_type=code
			&scope=snsapi_userinfo
			&state=STATE#wechat_redirect";
		\SeasLog::debug ('url##'.$url);
		$this -> view -> assign ('url', $url);
		$this -> view -> show ('game/roomlist');
	}

	public function getWxUserInfo ()
	{
		if (!isset($_GET['code']))
		{
			echo "error";
			exit ();
		}

		$code = trim ($_GET['code']);
		$appid = getConfig('wechat.APPID');
		$secret = getConfig('wechat.SECRET');
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
		\SeasLog::debug ('wxif####'.$url);
		$result = $this->sent_get ($url);
		var_dump( $result);
	}

	public function getUserInfo ()
	{
		$access_token = $this -> get_token();
		// $openid = $this -> get_openid ();
		
		if(isset($_SESSION['openid']))
		{
			$openid = $_SESSION['openid'];
		}
		else
		{
			$openid = session_id();
		}
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}
			&openid={$openid}&lang=zh_CN";

		\SeasLog::debug ('url####' . $url);
		$result = $this -> sent_get ($url);
		\SeasLog::debug ('userinfo###' . $result);
	}

	public function test()
	{

	}
}