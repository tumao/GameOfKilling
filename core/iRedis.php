<?php

use Predis\Client;

/**

* \Redis

*/

class iRedis
{

  const CONFIG_FILE = '../config/redis.php';

  protected static $redis;

  public static function init()
  {

    self::$redis = new Client(require self::CONFIG_FILE);

  }

  public static function set($key,$value,$time=null,$unit=null)
  {
    self::init();

    if ($time) {

      switch ($unit) {

        case 'h':

          $time *= 3600;

          break;

        case 'm':

          $time *= 60;

          break;

        case 's':

        case 'ms':

          break;

        default:

          throw new InvalidArgumentException('单位只能是 h m s ms');

          break;

      }

      if ($unit=='ms') {

        self::_psetex($key,$value,$time);

      } else {

        self::_setex($key,$value,$time);

      }

    } else {

      self::$redis->set($key,$value);

    }

  }

  public static function get($key)

  {

    self::init();

    return self::$redis->get($key);

  }

  public static function delete($key)
  {

    self::init();

    return self::$redis->del($key);

  }

  private static function _setex($key,$value,$time)
  {

    self::$redis->setex($key,$time,$value);

  }

  private static function _psetex($key,$value,$time)
  {

    self::$redis->psetex($key,$time,$value);

  }

/**
 *  key对应多个不同的value,如果value相同则不进行存储     （集合[set]）
 * 
 * */
  public static function sadd ($key, $array)
  {
            self::init();
            foreach ($array as $value)
            {
                    self::$redis -> sadd($key, $value);
            }
  }

/**
 * 获取key对应的value                （集合[set]）
 * 
 * */
  public static function smembers ($key)
  {
            self::init ();
            return  self::$redis -> smembers ($key);
  }


/**
 * 查看是否保存了对应的key
 * 
 * */
  public static function sismember ($key)
  { 
            self::init ();
            return  self::$redis -> sismember ($key);
  }

  /**
   *  增量为1
   * 
   * */
  public static function incr ($key)
  {
          self::init ();
          self::$redis -> incr ($key);
  }

  /**
   *  增量为step
   * 
   * */
  public static function incrBy ($key, $step = 1)
  {
          self::init ();
          self::$redis ->incrBy ($key, $step);
  }
}