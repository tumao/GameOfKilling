<?php
namespace App\Models;

use Core\Orms\Orm;
use Illuminate\Database\Capsule\Manager as DB;

class Weixin extends Orm
{

  	public $timestamps = false;

    public function checkSignature($timestamps, $nonce, $signature)
    {
      $token = 'quick';
      $tempArr = array($token, $nonce, $timestamps);
      sort($tempArr);
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