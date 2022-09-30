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
          if ($this->shouldBeActiveByDefault())
          {
            $model->setAttribute(
               getIsActiveKeyName(),
               true
             );
          }
          return;
      }
   }

   private static function shouldBeActiveByDefault()
   {
     return config('hive-alpha.processes.activate_by_default');
   }

   public static function getIsActiveKeyName()
   {
      return config('hive-alpha.column_names.state_active');
   }

   public static function getActiveState()
   {
     return $this->getAttribute($this->getIsActiveKeyName());
   }

}
