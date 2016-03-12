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
	    $Weixin = new Weixin();
	    $result = $Weixin->checkSignature($timestamp, $nonce, $signature);
	    \Seaslog::debug($result);
	    if($result)
	    {
	    	return true;
	    }
	    else
	    {
	    	return false;
	    }
	}
}