<?php
namespace App\Api;

use App\Controllers\BaseController;
use App\Models\Weixin;

class CallbackController extends BaseController
{
	/**
	 *	微信的接入接口
	 *
	 *
	 */
	public function weixin()
	{
		\Seaslog::debug(json_encode($GLOBALS));	// 输入
	    $signature = $this->g('signature');
	    $timestamp = $this->g('timestamp');
	    $nonce = $this->g('nonce');
	    $echoStr = $this->g('echostr');
	    $Weixin = new Weixin();
	    $result = $Weixin->checkSignature($timestamp, $nonce, $signature);

	    if($result)
	    {
	    	if($echoStr)
	    	{
	    		echo $echoStr;	// 校验签名成功，则返回$echostr,通知微信服务器校验成功
	    		exit;
	    	}
	    	else
	    	{
	    		$this->responseMsg();
	    	}
	    	
	    }
	    else
	    {
	    	echo false;
	    	exit;
	    }
	}


	public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		\Seaslog::debug('response__'.json_encode($postStr));
      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
              		$msgType = "text";
                	$contentStr = "Welcome to wechat world!";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
}