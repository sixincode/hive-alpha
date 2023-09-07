<?php

namespace Sixincode\HiveAlpha\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sixincode\HiveAlpha\Traits\GlobalUniqueIdentifierTrait;
use Sixincode\HiveAlpha\Traits\HasDataAndProperties;
use Sixincode\HiveAlpha\Traits\HasUserOwning;
use Spatie\Translatable\HasTranslations;

class HiveModel extends HiveModelMin
{
    use SoftDeletes;
    use HasFactory;
    use GlobalUniqueIdentifierTrait;
    use HasDataAndProperties;
    use HasUserOwning;
    use HasTranslations;

    public function initializeHiveModel()
    {
      $this->translatable[] = 'name';
      $this->translatable[] = 'description';

      $this->casts['created_at'] = 'datetime:d-m-Y';
      $this->casts['updated_at'] = 'datetime:d-m-Y';
      $this->casts['deleted_at'] = 'datetime:d-m-Y';

      // $this->fillable[] = 'slug';
      $this->fillable[] = 'name';
      $this->fillable[] = 'description';
    }

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
