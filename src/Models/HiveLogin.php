<?php

namespace Sixincode\HiveAlpha\Models;

class HiveLogin extends HiveModel
{
  public static function getTableAttribute()
  {
   return config('hive-alpha.table_names.logins');
  }

}
