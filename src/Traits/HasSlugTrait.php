<?php

namespace Sixincode\HiveAlpha\Traits;

use Spatie\Sluggable\HasSlug as SpatieSlug;
use Spatie\Sluggable\SlugOptions;

trait HasSlugTrait
{
  use SpatieSlug;

  public function initializeHasSlugTrait()
  {
      // if (app()->runningInConsole()) {
      //     return;
      // }

      $this->fillable[] = $this->getSlugKeyName();
   }

  public function getRouteKeyValue()
  {
      return $this->getAttribute($this->getRouteKeyName());
  }

  private static function shouldHaveSLug(): bool
  {
    return config('hive-alpha.processes.slug_by_default');
  }

  public static function getSlugKeyName(): string
  {
     return config('hive-alpha.column_names.slug');
  }

  public static function getSlug(): string
  {
    return $this->getAttribute(self::getSlugKeyName()) ?? $this->getAttribute($this->getRouteKeyName());
  }

  public static function getSlugRule()
  {
    return self::slugOriginElement() ?? 'slug';
  }

  public function getSlugOptions() : SlugOptions
  {
    return SlugOptions::create()
       ->generateSlugsFrom($this->getSlugRule())
       ->saveSlugsTo($this->getSlugKeyName())
       ->slugsShouldBeNoLongerThan(64)
       ->doNotGenerateSlugsOnUpdate()
       ;
  }
}
