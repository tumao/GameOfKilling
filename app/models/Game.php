<?php
namespace App\Models;

use Core\Orms\Orm;
use Illuminate\Database\Capsule\Manager as DB;

class Game extends Orm
{

  	public $timestamps = false;

      /**
       *  获取一个递增 不连续的房间号
       * 
       * */
      private function getIncRandRoom ()
      {
                $redis = new \iRedis ();
                if (!$redis->get('roomNum'))
                {
                        $redis -> set ('roomNum', 5000);
                }

                $rand = rand (1, 10);           // 生成一个1-10的随机数字
                $redis->incrBy ('roomNum', $rand);
                return $redis->get('roomNum');
      }

      /**
       * 创建游戏
       * 
       * @param array $setting 房间配置信息
       * @param string  $password 房间密码
       * @return string 房间号
       * */
      public function createGame ($setting, $password = '', $openid)
      {
                $roomId = $this -> getIncRandRoom ();             // 获取递增不连续的房间号
                $setting = json_encode ($setting);
                DB::insert('INSERT INTO 
                                          `game` (roomid, setting, password, openid)
                                          VALUES (?, ?, ?, ?) ',
                                         [$roomId, $setting, $password, $openid]);
                return $roomId;
      }

      /**
       *    查看是否存在该房间
       * 
       *     @param string $roomid 房间号
       * */
      public function isRoom ($roomid)
      {
                $result = DB::select ("SELECT * FROM `game` WHERE roomId = ?", [$roomid]);

                \Seaslog::debug ('##isroom##'. json_encode($result));
                if (!empty($result))        //存在房间
                {
                            return 1;
                }
                else                                    // 不存在房间
                {
                            return -1;
                }
      }

      /**
       *    房间的人员配置信息
       * 
       * 
       * */
      public function getRoomConf ($roomid)
      {
                $room = DB::select ('SELECT * FROM `game` WHERE roomId = ?', [$roomid]);
                $result = '';
                if ($room)
                {
                             $result = json_decode($room[0] ->setting);
                }
                return $result;
      }

      /**
       *   房间的总人数
       * 
       * */
      public function getSumMember ($roomid)
      {
                $sum = 0;
                $setting = $this-> getRoomConf ($roomid);
               if ($setting)
               {
                        $sum = $setting ->killer + $setting->commoner + $setting->police;    
               }
                
                return $sum;
      }

      /**
       *  加入游戏
       * 
       * */
      public function partGame ($roomid, $openid)
      {
                \Seaslog::debug ('##roomid#'.$roomid);
                \Seaslog::debug ('##openid#'.$openid);
              $redis = new \iRedis ();
              $sumMember = $this -> getSumMember ($roomid);

              if ($sumMember == 0)                          // 房间不存在
              {
                        return -2;                                                                  // 房间不存在
              }

              if ($users = $redis->smembers($roomid))
              {
                        $memberCount = count ($users);
                        if ($memberCount >= $sumMeber)                      // 查看已经加入到游戏中的人是否超过游戏配置
                        {
                                return -1;                                                            //  
                        }
              }
              $redis ->sadd ($roomid, [$openid]);                              // 加入游戏
              return 1;
      }
}