<?php
namespace App\Controllers\Front\Game;

use App\Controllers\BaseController;

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
		$this -> view -> addTitle ('创建游戏');
		$this -> view ->addCss ('front/css/game.css');
		$this -> view ->addJs ('front/js/game.js');
		
		$this -> view -> show ('game/index');
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
		$this -> view -> addCss ('front/css/roomlist.css');
		$this -> view -> addJs ('front/js/game.js');
		
		$this -> view -> show ('game/roomlist');
	}
}