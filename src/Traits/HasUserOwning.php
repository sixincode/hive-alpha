<?php

namespace Sixincode\HiveAlpha\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait HasUserOwning
{
  public static function bootHasUserOwning()
  {
      if (app()->runningInConsole()) {
          return;
      }
      static::creating(function (Model $model) {
          if(auth()->check()){
            $model->setAttribute(
              getUserGlobalKeyName(),
              auth()->user()->getGlobalId()
            );
          }

          return;         
       });
   }

   public function getUserGlobalKeyName()
   {
     return config('hive-alpha.column_names.key_global');
   }

}
