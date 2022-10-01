<?php

namespace Sixincode\HiveAlpha\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait HasActiveState
{
  public static function bootHasActiveState()
  {
      if (app()->runningInConsole()) {
          return;
      }
      static::creating(function (Model $model) {
          if (self::shouldBeActiveByDefault())
          {
            $model->setAttribute(
               self::getIsActiveKeyName(),
               true
             );
          }
          return;
      }
   }

   private static function shouldBeActiveByDefault(): bool
   {
     return config('hive-alpha.processes.activate_by_default');
   }

   public static function getIsActiveKeyName(): string
   {
      return config('hive-alpha.column_names.state_active');
   }

   public static function getActiveState(): bool
   {
     return $this->getAttribute($this->getIsActiveKeyName());
   }

}
