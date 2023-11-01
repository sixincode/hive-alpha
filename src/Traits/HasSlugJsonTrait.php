<?php

namespace Sixincode\HiveAlpha\Traits;

use Spatie\Sluggable\HasTranslatableSlug as SpatieSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

trait HasSlugJsonTrait
{
  use SpatieSlug;

  public function initializeHasSlugJsonTrait()
  {
    static::saving(function (Model $model) {
        collect($model->getTranslatedLocales($model->getSlugRule()))
            ->each(fn (string $locale) => $model->setTranslation(
                $this->getSlugKeyName(),
                $locale,
                $model->generateSlug($locale)
            ));
    });
    $this->casts[$this->getSlugKeyName()] = 'array';
    $this->fillable[] = $this->getSlugKeyName();
    $this->translatable[] = $this->getSlugKeyName();

  }

  protected function generateSlug(string $locale): string
  {
      $slugger = config('tags.slugger');

      $slugger ??= '\Illuminate\Support\Str::slug';

      return call_user_func($slugger, $this->getTranslation('name', $locale));
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
     return $this->getAttribute(self::getSlugKeyName());
   }

   public static function getSlugRule()
   {
     return self::slugOriginElement() ?? 'slug';
   }

   public function getSlugOptions() : SlugOptions
   {
     return SlugOptions::create()
        ->generateSlugsFrom(
          $this->getSlugRule()
        )
        ->saveSlugsTo(
          $this->getSlugKeyName()
        )->slugsShouldBeNoLongerThan(64)
        ;
   }
}
