<?php

namespace Sixincode\HiveAlpha\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug as SpatieSlug;
use Spatie\Sluggable\SlugOptions;

trait HasSlug
{
  use SpatieSlug;

  $this->appends[] = 'slug_origin';

  public static function bootHasSlug()
  {
      if (app()->runningInConsole()) {
          return;
      }
   }

   private static function shouldHaveSLug(): bool
   {
     return config('hive-alpha.processes.slug_by_default');
   }

   public static function getSlugKeyName(): string
   {
      return config('hive-alpha.column_names.slug_primary');
   }

   public static function getSlug(): string
   {
     return $this->getAttribute(self::getSlugKeyName());
   }

   public function getSlugOriginAttribute()
   {
     return (isset(self::slugOriginElement()))
             ? self::slugOriginElement()
             : 'slug';
   }

   public function getSlugOptions() : SlugOptions
   {
     return SlugOptions::createWithLocales(
          array_keys(config('hive-lang.supportedLocales'))
       )->generateSlugsFrom(
          function($model, $locale)
          {
            return "{$locale} {$model->slugOrigin}";
          }
        )->saveSlugsTo(
          self::getSlugKeyName()
        )
        // ->slugsShouldBeNoLongerThan(64)
        ;
   }
}
