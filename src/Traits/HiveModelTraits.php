<?php

namespace Sixincode\HiveAlpha\Traits;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

trait HiveModelTraits
{
  use HasSlugTrait;
  use HasTranslations;
  use HasUserOwning;
  use HasDataAndProperties;
  use GlobalUniqueIdentifierTrait;
  use SoftDeletes;

  public function initializeHiveModelTraits()
  {
    $this->translatable[] = 'name';
    $this->translatable[] = 'description';

    $this->casts['name'] = 'array';
    $this->casts['description'] = 'array';

    $this->filterable[] = 'id';
    $this->filterable[] = 'name';

    $this->orderable[] = 'id';
    $this->orderable[] = 'name';

    $this->fillable[] = 'name';
    $this->fillable[] = 'description';

  }

  public $translatable = [];
  public $filterable = [];
  public $orderable = [];
  // public $fillable = [];


  public static function getLocale()
  {
      return app()->getLocale();
  }

  public function setNewValue($key, $value)
  {
    if (in_array($key, $this->fillable) && ! is_array($value)) {
        $this->update([$key,$value]);
    }
  }

  public function setAttribute($key, $value)
  {
      if (in_array($key, $this->translatable) && ! is_array($value)) {
          return $this->setTranslation($key, static::getLocale(), $value);
      }

      return parent::setAttribute($key, $value);
  }

}
