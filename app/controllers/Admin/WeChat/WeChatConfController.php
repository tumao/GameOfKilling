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
		$appid = $this->getAppId();
		$secret = $this->getSecret();
		$result = $this->mget("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}");
		var_dump( $result);

	}
}
