<?php

namespace Sixincode\HiveAlpha\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Sixincode\HiveHelpers\Traits\FieldsTrait;

trait GlobalUniqueIdentifierTrait
{
  use FieldsTrait;

  protected static function bootGlobalUniqueIdentifierTrait()
  {
    // if(app()->runningInConsole()) {
    //     return;
    // }

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

  public function initializeGlobalUniqueIdentifierTrait()
  {
    $this->fillable[] = self::getGlobalIdKeyName();
  }

  // public static function getUserIdAttribute()
  // {
  //   return $this->getGlobalIdKeyName();
  // }

  private static function shouldGenerateGlobalId(): bool
  {
    return config('hive-alpha.processes.global_by_default');
  }

  public static function getGlobalIdKeyName(): string
  {
    return self::globalFieldName();
  }

  public function getGlobalId(): string
  {
    return $this->getAttribute($this->getGlobalIdKeyName());
  }

  public function getGlobalKey(): string
  {
    return $this->getGlobalId();
  }

  public function getGlobalMorphId(): string
  {
    return $this->getId();
  }

  public function getGlobalMorphType(): string
  {
    return self::class;
  }
}
