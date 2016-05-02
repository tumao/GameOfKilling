<?php
namespace App\Models;

use Core\Orms\Orm;
use Illuminate\Database\Capsule\Manager as DB;

class Config extends Orm
{

    public $timestamps = false;

    /**
     * 获取配置项
     *
     * key String
     */
    public function getConfig($key)
    {
        $conf = DB::select('SELECT * FROM `conf` WHERE `key` = ? ORDER BY id desc LIMIT 1', array(
            $key
        ));
        
        if ($conf) 
        {
            $config = $conf[0];
            $value = $config->value;
            $value = json_decode($value);
            return $value;
        } 
        else 
       {
            throw new \Exception(\Lang::get('config.NO_SUCH_CONFIG')); // 没有找到对应的配置项
        }
    }

    /**
     * 存储配置项到数据库
     *
     * key String
     * value array
     */
    public function setConfig($key, $value)
    {
        $value = json_encode($value);
        if ($key && $value) 
        {
        	DB::insert('INSERT INTO `conf` (key, value) VALUES (?,?)' , array($key, $value));
        }
    }

    /**
     * 更新配置项
     */
    public function updateConfig($key, $value)
    {
        $value = json_encode($value);
        if ($key && $value) {
            DB::update('UPDATE `conf` SET value=? WHERE key=?', array(
                $value,
                $key
            ));
        }
    }
}