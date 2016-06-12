<?php
namespace App\Controllers\Front\Game;

use App\Controllers\BaseController;
use App\Models\Game;
use App\Models\Weixin;
use  Symfony\Component\HttpFoundation\Response;
use Guzzle\Http\Message\Request;

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
		$this -> view ->addJs ('front/js/game.js');
		$this -> view -> addTitle ('创建游戏');
		$this -> view ->addCss ('front/css/game.css');
		
		$this -> view -> show ('game/index');
	}


	/**
	 * 已经创建的房间
	 * 
	 * 
	 * */
	public function room()
	{
		$Weixin = new Weixin ();
		$openid  = $Weixin ->getOpenid ();
		$token = $this -> get_token ();
		$userInfo = $Weixin->getUserInfo ($token, $openid);
		$userInfo = json_decode ($userInfo);

		if (isset($_GET['commoner']))
		{
			$this -> view -> addCss ('front/css/room.css');
			$commoner = $_GET['commoner'];
			$killer = $_GET['killer'];
			$police = $_GET['police'];
			$password = '';

			if (isset($_GET['password']))
			{
				$password = $_GET['password'];
				 $this -> view -> assign('password', $_GET['password']);
			}
			$setting = ['killer' => $killer, 'commoner' => $commoner, 'police', $police];
			$Game = new Game();
			
			$roomid = $Game -> createGame($setting, $password, $userInfo->openid);


			$this -> view -> assign ('password', $password);
			$this -> view -> assign ('roomid', $roomid);
			$this -> view -> assign ('killer', $killer);
			$this -> view -> assign ('police', $police);
			$this -> view -> assign ('commoner', $commoner);

			$this -> view -> show ('game/room');
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

		$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirectUrl}&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";

		$this -> view -> assign ('url', $url);
		$this -> view -> show ('game/roomlist');
	}

	/**
	 *授权
	 * 
	 * @param String $[redirecturl] [<微信授权后跳转地址>]
	 * */
	public function authorize ()
	{
		$Weixin = new Weixin ();
		$openid = $Weixin->getOpenid ();
		$token = $this -> get_token ();
		$userinfo = $Weixin -> getUserInfo($token, $openid);

	}

	/**
	 * 微信授权回调地址
	 * 
	 * 
	 * */
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

		$result = $this->sent_get ($url);
		$result = json_decode($result);
		if ($result->openid)
		{
			$_SESSION['openid'] = $result->openid;
		}

		$userinfo = $this->getUserInfo ($result->openid);		// 获取用户信息
		$userinfo = json_decode ($userinfo);
		if ($userinfo)
		{
			$_SESSION['nickname'] = $userinfo->nickname;
			$_SESSION['headimgurl'] = $userinfo->headimgurl;
		}
	}

	public function mq ()
	{
		$weixin = new Weixin ();
		$weixin -> getMsgFromQueue("oMe5vtx7hAFDE9Q88xUEbpg7lFl4", "gh_e39949e7ee04");
	}
}