<?php
namespace App\Models;

use Core\Orms\Orm;
use Illuminate\Database\Capsule\Manager as DB;
use App\Models\Game;

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
                                                      if (is_numeric($keyword))
                                                      {             
                                                                    $Game = new Game ();
                                                                    $partResult = $Game ->partGame ($keyword, $fromUsername);                     // 加入到游戏中
                                                                    \Seaslog::debug ('#result.....#' . $partResult);
                                                                    if ($partResult == -1)                  // 房间已满
                                                                    {
                                                                            $this->replyText($fromUsername, $toUsername, "房间已满，请再创建房间");    
                                                                    }
                                                                    elseif ($partResult == -2)          // 不存在该房间
                                                                    {
                                                                            $this->replyText($fromUsername, $toUsername, "该房间不存在，请创建");
                                                                    }
                                                                    else
                                                                    {
                                                                            $this->replyText($fromUsername, $toUsername, "成功加入{$keyword}号房间，等待其他玩家加入");
                                                                    }
                                                                    
                                                      }
                                                      else
                                                      {
                                                                    $contentStr = $this -> getMsgFromQueue ($fromUsername, $toUsername, $msgType);
                                                      }
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
            private function changQueueType ($id)
            {
                        $result = DB::update ("UPDATE `msgQueue` SET `isSent` = ? WHERE id = ?", [1, $id]);
                        return $result;
            }

            /**
             *  从消息队列中取一条消息
             * 
             * */
            public function getMsgFromQueue ($fromUserName, $toUserName, $msgType='text')
            {
                        $data = DB::select ('SELECT * FROM `msgQueue` WHERE  fromUserName = ? AND toUserName = ? AND isSent = ? AND msgType = ? ORDER BY id DESC', [$fromUserName, $toUserName, 0, $msgType]);

                        \Seaslog::debug ('#queue#'.json_encode($data));

                        $result = '';

                        if (!empty($data))
                        {
                                $result = $data[0]->content;
                                $this -> changQueueType ($data[0]->id);                                                // 更改已经发送的消息在队列中的状态
                        }
                        else
                        {
                                $result = '房间过期，请重新创建房间.';
                        }
                        return $result;
            }

                /**
                 *授权
                 * 
                 * @param String $[redirecturl] [<微信授权后跳转地址>]
                 * */
                public function authorize ($redirectUrl)
                {
                            $appid = getConfig ('wechat.APPID');        // appid
                            $redirectUrl = urlencode ($redirectUrl);

                            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirectUrl}&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";       // 微信授权地址

                            header ("Location:".$url);
                }

                /**
                 *  获取用户的openid
                 * 
                 * */
                public function getOpenid ($redirecturl = '')
                {
                            if (isset($_GET['code']))
                            {
                                        $code = trim ($_GET['code']);
                                        $appid = getConfig('wechat.APPID');
                                        $secret = getConfig('wechat.SECRET');
                                        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
                                        $result = $this -> sent_get ($url);
                                        $result = json_decode ($result);

                                        $_SESSION['openid'] = $result ->openid;

                                        return $result->openid;

                            }

                            if ( !$redirecturl)
                            {
                                        $base_url = $_SERVER['SERVER_NAME'];
                                        $uri = $_SERVER['REQUEST_URI'];
                                        $redirecturl = "http://".$base_url.$uri;
                            }

                            if (isset($_SESSION['openid']))     // 如果用户已经首权过
                            {
                                        return $_SESSION['openid'];
                            }
                            else
                            {
                                        $this -> authorize ($redirecturl);
                            }
                }

                    /**
                     * 获取用户信息
                     * 
                     * */
                    public function getUserInfo ($access_token ,$openid)
                    {
                        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid={$openid}";
                        $result = $this -> sent_get ($url);
                        return $result;
                    }


}