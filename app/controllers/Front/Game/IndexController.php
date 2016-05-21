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
}