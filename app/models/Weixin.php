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
}