<?php
namespace App\Api;

use App\Controllers\BaseController;
use App\Models\Weixin;

class CallbackController extends BaseController
{
	public function weixin()
	{
	    $signature = $this->g('signature');
	    $timestamp = $this->g('timestamp');
	    $nonce = $this->g('nonce');
	    $echoStr = $this->g('echostr');
	    $Weixin = new Weixin();
	    $result = $Weixin->checkSignature($timestamp, $nonce, $signature);
	    $request = $_REQUEST;
	    \Seaslog::debug(json_encode($request));

	    if($result)
	    {
	    	\Seaslog::debug('the check is right');
	    	return $echoStr;
	    }
	    else
	    {
	    	\Seaslog::debug('the check is wrong');
	    	return false;
	    }
	}
}