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
		$redirectUrl = urlencode('http://socketio.cn/getcode');
		// $user_info = $Weixin ->getWxUserInfo ($access_token, $get_openid);
		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}
			&redirect_uri={$redirectUrl}
			&response_type=code
			&scope=snsapi_userinfo
			&state=STATE#wechat_redirect";
		\SeasLog::debug ('url##'.$url);
		$this -> view -> assign ('url', $url);
		$this -> view -> show ('game/roomlist');
	}

	public function getCode ()
	{
		if (isset ($_GET['code']))
		{
			$code = trim ($_GET['code']);
			return $code;
		}

		echo "sorry, error";
		exit();
	}
}