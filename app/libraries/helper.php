<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Amitav Roy
 * Date: 1/15/14
 * Time: 6:04 PM
 * To change this template use File | Settings | File Templates.
 */
 
class Helper
{
  public static function last_insert_id()
  {
    return DB::getPdo()->lastInsertId();
  }

  public static function last_query($query = false)
  {
    $queries = DB::getQueryLog();
    $last_query = end($queries);
    if ($query)
      return $last_query['query'];
    else
      return $last_query;
  }

  public static function dsm($var, $exit = 0)
  {
    print '<pre class="dump">';
    print_r($var);
    print '</pre>';

    if ($exit != 0 )
      exit();
  }

  public static function fetchCacheData($name)
  {
    $cache = Cache::get($name);
    if ($cache)
    {
      return $cache;
    }
    else
    {
      return false;
    }
  }

  public static function getCacheIfPresent($cacheId)
  {
    if (Config::get('app.caching') == 'true')
    {
      $value = Cache::get($cacheId);

      if ($value)
      {
        return $value;
      }
      else
        return false;
    }
    else
    {
      return false;
    }
  }
}