<?php
namespace App\Api;

use App\Controllers\BaseController;
use App\Models\Weixin;

class CallbackController extends BaseController
{
	public function weixin()
	{
		$weixin = new Weixin();	// Model of Weixin
		$data = $weixin->getData;
	}
}