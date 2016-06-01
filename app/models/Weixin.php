<?php
namespace App\Models;

use Core\Orms\Orm;
use Illuminate\Database\Capsule\Manager as DB;

class Weixin extends Orm
{

  	public $timestamps = false;

              public function checkSignature($timestamps, $nonce, $signature)
              {
                        $token = getConfig('wechat.TOKEN'); // 获取配置中的token
                        $tempArr = array($token, $timestamps, $nonce);
                        sort($tempArr,SORT_STRING);
                        $tempStr = implode($tempArr);
                        $tempStr = sha1($tempStr);
                        if($tempStr == $signature)
                        {
                                return true;
                        }
                        else
                        {
                                return false;
                        }
              }


            public function responseMsg()
            {
                            //get post data, May be due to the different environments
                            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
                            \Seaslog::debug ('this is test of debug function');
                            \Seaslog::debug('response__'.json_encode($postStr));
                            //extract post data
                            if (!empty($postStr))
                            {
                                        
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
                                              $contentStr = "你好啊2!";
                                              $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                              echo $resultStr;
                                            }
                                            else
                                            {
                                              echo "Input something...";
                                            }

                            }
                            else 
                            {
                                  echo "";
                                  exit;
                            }
            }
}