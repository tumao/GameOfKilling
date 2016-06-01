<?php
namespace App\Api;

use App\Controllers\BaseController;
use App\Models\Weixin;

class CallbackController extends BaseController
{
	/**
	 *	微信的接入接口
	 *
	 */
	public function weixin()
	{
		$signature = $this ->g ('signature');
	    	$timestamp = $this ->g ('timestamp');
	    	$nonce = $this ->g ('nonce');
	    	$echoStr = $this ->g ('echostr');
	    	$Weixin = new Weixin ();
	    	$result = $Weixin ->checkSignature($timestamp, $nonce, $signature);

	    	if ($result)
	    	{
	    		if ($echoStr)
	    		{
	    			echo $echoStr;	// 校验签名成功，则返回$echostr,通知微信服务器校验成功
	    			exit;
	    		}
		    	else
		    	{
		    		$Weixin -> responseMsg ();
		    	}
	    	
	  	 }
	    	else
		{
	    		echo false;
		    	exit;
		}
	}

}