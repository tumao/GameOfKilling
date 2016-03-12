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

	public function generageMenu()
	{
		$config_path = CONFIG_PATH.'/wx_menu.php';
		$menus = require($config_path);
		$token = $this->get_token();
		$menus = json_encode($menus,JSON_UNESCAPED_UNICODE);
		// \Seaslog::debug('menus__'.$menus);
		// $result = $this->sent_post("https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$token}",$menus);
		
		$result = $this->create_menu($menus, $token);
		\Seaslog::debug('genmenu__'.json_encode($result));
	}

	private function create_menu($data, $token)
	{
		header("Content-type: text/html; charset=utf-8");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		if (curl_errno($ch)) {
		  return curl_error($ch);
		}

		curl_close($ch);
		return $tmpInfo;
	}
}
