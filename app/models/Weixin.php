<?php
namespace App\Models;

use Core\Orms\Orm;
use Illuminate\Database\Capsule\Manager as DB;

class Weixin extends Orm
{

  	public $timestamps = false;

              /**
               *  检验签名
               * 
               * */
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

              /**
               *    自动回复
               * 
               * */
            public function responseMsg()
            {
                            //get post data, May be due to the different environments
                            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
                            // \Seaslog::debug('response__'.json_encode($postStr));
                            //extract post data
                            if (!empty($postStr))
                            {
                                        
                                        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                                        $fromUsername = $postObj->FromUserName;
                                        if (!empty($fromUsername))
                                        {
                                                    session_id ($fromUsername);
                                                    session_start();
                                                    $_SESSION['openid'] = $fromUsername;
                                                    \Seaslog::debug ('session_id###'.session_id());
                                        }
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
                                                      $contentStr = "你好啊!";
                                                      $this->replyText($fromUsername, $toUsername, $contentStr);
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

            /**
             *  自动回复文本信息
             * 
             * */
            public function replyText ($fromUsername, $toUsername, $content)
            {
                            $content = "this is content of my test";
                            $textTpl = "<xml>
                                                          <ToUserName><![CDATA[%s]]></ToUserName>
                                                          <FromUserName><![CDATA[%s]]></FromUserName>
                                                          <CreateTime>%s</CreateTime>
                                                          <MsgType><![CDATA[%s]]></MsgType>
                                                          <Content><![CDATA[%s]]></Content>
                                                          <FuncFlag>0</FuncFlag>
                                                  </xml>";

                            $time = time ();
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, 'text', $content);
                            echo $resultStr;
            }

            /**
             * 回复图文消息
             * 
             * */
            public function replyImgText ($toUser, $fromUser, $textContent)
            {
                            $tpl = "<xml>
                                            <ToUserName><![CDATA[toUser]]></ToUserName>
                                            <FromUserName><![CDATA[fromUser]]></FromUserName>
                                            <CreateTime>12345678</CreateTime>
                                            <MsgType><![CDATA[news]]></MsgType>
                                            <ArticleCount>2</ArticleCount>
                                            <Articles>
                                                            <item>
                                                                        <Title><![CDATA[title1]]></Title> 
                                                                        <Description><![CDATA[description1]]></Description>
                                                                        <PicUrl><![CDATA[picurl]]></PicUrl>
                                                                        <Url><![CDATA[url]]></Url>
                                                            </item>
                                                            <item>
                                                                        <Title><![CDATA[title]]></Title>
                                                                        <Description><![CDATA[description]]></Description>
                                                                        <PicUrl><![CDATA[picurl]]></PicUrl>
                                                                        <Url><![CDATA[url]]></Url>
                                                            </item>
                                            </Articles>
                                        </xml>";
                            $time = time ();
            }

}