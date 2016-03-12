<?php
namespace App\Controllers\Admin\Wechat;

use App\Controllers\Admin\ABaseController;
use App\Models\User;

class WeChatConfController extends ABaseController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getAppid()
	{
		$openid = $this->get_openid();

	}

	public function generageMenu()
	{
		$config_path = CONFIG_PATH.'/wx_menu.php';
		$menus = require($config_path);
		$token = $this->get_token();
		$menus = json_encode($menus);
		\Seaslog::debug('menus__'.$menus);
		$result = $this->sent_post("https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}",$menus);
		\Seaslog::debug('genmenu__'.json_encode($result));
	}
}
