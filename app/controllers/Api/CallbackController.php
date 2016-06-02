<?php
namespace App\Api;

use App\Controllers\BaseController;
use App\Models\Weixin;

class CallbackController extends BaseController
{

	/**
	 *	微信的接入接口
	 *
	 **/
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
	    			echo $echoStr;					// 校验签名成功，则返回$echostr,通知微信服务器校验成功
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

	public function getXmlData ()
	{
		$xmlStr = '<xml>
				<ToUserName><![CDATA[gh_e39949e7ee04]]></ToUserName>
				<FromUserName><![CDATA[oMe5vtx7hAFDE9Q88xUEbpg7lFl4]]></FromUserName>
				<CreateTime>1464846857</CreateTime>
				<MsgType><![CDATA[text]]></MsgType>
				<Content><![CDATA[22222]]></Content>
				<MsgId>6291469344908684100</MsgId>
			</xml>';

	}

}