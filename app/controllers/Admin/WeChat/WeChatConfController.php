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
		echo $openid = $this->get_token();
	}

	public function clearToken()
	{
		$this->clear_token();
	}

	/**
	 *	微信生成菜单
	 *
	 *
	 */
	public function generageMenu()
	{
		$config_path = CONFIG_PATH.'/wx_menu.php';				// get config file of wx menu
		$menus = require($config_path);
		$token = $this->get_token();
		$menus = json_encode($menus,JSON_UNESCAPED_UNICODE);		// 第二个参数必不可少，意思是json_encode后中文不转码
		$result = $this->sent_post("https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}",$menus);	// 发送post请求
		$data = json_decode ($result);	// 解析返回的json数据
		if ($data->errcode == 0)
		{
			echo "Success.......";
		}
		else
		{
			$token = $this ->get_token(true);			// 如果post请求失败，则重新生成token再此请求
			$result = $this->sent_post("https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}",$menus);
			$data = json_decode ($result);
			if ( $data ->errcode == 0)
			{
				echo 'Success ........';
			}
		}
		\Seaslog::debug('genmenu__'.json_encode($result));
	}
}
