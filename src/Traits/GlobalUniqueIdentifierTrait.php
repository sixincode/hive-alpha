<?php

namespace Sixincode\HiveAlpha\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Sixincode\HiveHelpers\Traits\FieldsTrait;

trait GlobalUniqueIdentifierTrait
{
  use FieldsTrait;

  public function initializeGlobalUniqueIdentifierTrait()
  {
    if(app()->runningInConsole()) {
        return;
    }
    $this->fillable[] = self::getGlobalIdKeyName();

    static::creating(function (self $model) {
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
    return self::globalFieldName();
  }

  public static function getGlobalId(): string
  {
    return $this->getAttribute($this->getGlobalIdKeyName());
  }
}
