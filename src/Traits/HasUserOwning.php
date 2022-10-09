<?php

namespace Sixincode\HiveAlpha\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Sixincode\HiveHelpers\Traits\FieldsTraits;

trait HasUserOwning
{
  use FieldsTraits;

  public static function bootHasUserOwning()
  {
      if (app()->runningInConsole()) {
          return;
      }
      static::creating(function (Model $model) {
          if(auth()->check() && self::shouldBeUserAffiliated()){
            $model->setAttribute(
              self::globalUserFieldName(),
              auth()->user()->getGlobalId()
            );
          }
          return;
       });
   }

   private static function shouldBeUserAffiliated(): bool
   {
     return true;
   }

}
