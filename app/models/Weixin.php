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
                            \Seaslog::debug('response__'.json_encode($postStr));
                            //extract post data
                            if (!empty($postStr))
                            {
                                        
                                            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                                            $fromUsername = $postObj->FromUserName;
                                            $toUsername = $postObj->ToUserName;
                                            $keyword = trim($postObj->Content);
                                            $time = time();
                                            if(!empty( $keyword ))
                                            {
                                                      $msgType = "text";
                                                      $contentStr = $this -> getMsgFromQueue ($fromUsername, $toUsername, $msgType);
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
             *  将消息添加到队列中
             * 
             * 
             * */
            public function addMsgToQueue ($fromUserName, $toUserName, $msgType, $content)
            {
                        $time = time ();
                        $isSent = 0;
                        DB::insert ('INSERT INTO 
                                `msgQueue`(fromUserName, toUserName, createTime, msgType, content, isSent)
                                VALUES (?, ?, ?, ?, ?, ?)
                                ', [$fromUsername, $toUserName, $createTime, $msgType, $content, $isSent]);
            }


            /**
             *  改变消息队列的状态
             * 
             * */
            public function changQueueType ($id)
            {
                        $result = DB::update ("UPDATE `msgQueue` SET `isSent` = ? WHERE id = ?", [1, $id]);
                        return $result;
            }

            private function getMsgFromQueue ($fromUserName, $toUserName, $msgType='text')
            {
                        // \Seaslog::debug ('##fromusername' . $fromUserName);
                        // \Seaslog::debug ('##tousername' . $toUserName);
                        $result = DB::select ('SELECT * FROM `msgQueue` WHERE  fromUserName = ? AND toUserName = ? AND isSent = ? ORDER BY id DESC', [$fromUsername, $toUsername, $msgType]);
                        // \Seaslog::debug ('##msgQueue##'. json_encode($result));
                        // return $result[0]->content;
                        return 'this is a message queue test';
            }

}