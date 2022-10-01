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
    static::creating(function (Model $model) {
          if(self::shouldGenerateGlobalId())
          {
            $model->setAttribute(
              self::getGlobalIdKeyName(),
              Str::uuid()
            );
          }
          return;
      });
  }

  private static function shouldGenerateGlobalId(): bool
  {
    return config('hive-alpha.processes.global_by_default');
  }

  public static function getGlobalIdKeyName(): string
  {
    return config('hive-alpha.column_names.key_global');
  }

  public static function getGlobalId(): string
  {
    return $this->getAttribute($this->getGlobalIdKeyName());
  }
}
