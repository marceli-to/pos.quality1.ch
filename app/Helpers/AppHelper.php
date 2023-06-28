<?php
namespace App\Helpers;
use Illuminate\Support\Str;

class AppHelper
{
  public static function partition(Array $list, $p)
  {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    
    for($px = 0; $px < $p; $px ++)
    {
      $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
      $partition[$px] = array_slice($list, $mark, $incr);
      $mark += $incr;
    }
    return $partition;
  }
}