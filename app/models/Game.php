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
      public function getIncRandRoom ()
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


}