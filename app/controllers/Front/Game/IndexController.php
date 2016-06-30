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
		// $Weixin = new Weixin ();
		// \Seaslog::debug ('###test###');
		// $openid  = $Weixin ->getOpenid ();
		// \Seaslog::debug ('###openid###'. $openid);

		// $token = $this -> get_token ();
		// $userInfo = $Weixin->getUserInfo ($token, $openid);

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
			$setting = ['killer' => $killer, 'commoner' => $commoner, 'police'=> $police];		// 游戏的人员配置
			$Game = new Game();
			
			$roomid = $Game -> createGame($setting, $password, '11111');
			// $roomid = $Game -> createGame($setting, $password, '123456');

			$this -> view -> assign ('password', $password);
			$this -> view -> assign ('roomid', $roomid);
			$this -> view -> assign ('killer', $killer);
			$this -> view -> assign ('police', $police);
			$this -> view -> assign ('commoner', $commoner);

			$this -> view -> show ('game/room');
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
		$game = new Game ();
		echo $game->partGame (5010, 77266);
	}

	public function score ()
	{	
		$redis = new \iRedis ();
		$win = $redis -> get ('win') ? $redis -> get ('win') : 0;
		$lose = $redis -> get ('lose') ? $redis -> get ('lose') : 0;
		$this -> view ->assign ('win', $win);
		$this -> view -> assign ('lose', $lose);

		$this -> view ->addCss ('front/css/game.css');
		$this -> view -> show ('game/scoreList');
	}


	

	// 当前局的结果，是胜利还是失败
	public function setRole ()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$this -> view ->addJs ('front/js/game.js');
		if ($method == 'GET')
		{
			$this -> view -> show ('game/setRole');
		}
		else
		{
			$rand  = rand (1,3);
			$redis = new \iRedis ();
			$redis->set ('role', $rand);
			echo $rand;
		}
	}

	public function setResult ()
	{
		$redis = new \iRedis ();

		$roleId = $redis -> get ('role');
		$winId = $_GET['winid'];

		if ($roleId == $winId)
		{	
			$win = $redis -> get ('win');
			if (!$win)
			{
				$win = 0;
			}
			$redis-> set ('win', $win + 1);
			
		}
		else 			// 杀手输， 其他赢
		{
			$lose = $redis -> get ('lose');
			if (!$lose)
			{
				$lose = 0;
			}
			$redis-> set ('lose', $lose + 1);
		}
		echo 1;
	}

}