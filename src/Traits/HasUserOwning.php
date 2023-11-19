<?php

namespace Sixincode\HiveAlpha\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Sixincode\HiveHelpers\Traits\FieldsTrait;

trait HasUserOwning
{
  use FieldsTrait;

  public function initializeHasUserOwning()
  {
      // if (app()->runningInConsole()) {
      //     return;
      // }
      static::creating(function (Model $model) {
          if(auth()->check() && self::shouldBeUserAffiliated()){
            $model->setAttribute(
              self::globalUserFieldName(),
              auth()->user()->getGlobalId()
            );
          }
          // return;
       });

       $this->fillable[] = self::globalUserFieldName();
   }

   private static function shouldBeUserAffiliated(): bool
   {
     return true;
   }

   public function userOwner()
   {
      return $this->belongsTo(config('hive-alpha.models.user'), self::globalUserFieldName(), self::globalUserFieldName());
   }

   public function getAuthorArray()
   {
       return [
         "author_name"     => $this->modified_at,
         "author_username" => $this->modified_at,
       ];
   }

}
