<?php

namespace Sixincode\HiveAlpha\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait GlobalUniqueIdentifierTrait
{
  public static function bootGlobalUniqueIdentifierTrait()
  {
    if(app()->runningInConsole()) {
        return;
    }
    static::creating(function (self $model) {
          if($model->shouldGenerateGlobalId())
          {
            $model->setAttribute(
              getGlobalIdKeyName(),
              Str::uuid()
            );
          }

          return;
      });
  }

  private static function shouldGenerateGlobalId()
  {
    return true;
  }

  public static function getGlobalIdKeyName()
  {
    return config('hive-alpha.column_names.key_global');
  }

  private getGlobalId()
  {
    return $this->getAttribute($this->getGlobalIdKeyName());
  }
}
