<?php

namespace Sixincode\HiveAlpha\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sixincode\HiveAlpha\Traits\GlobalUniqueIdentifierTrait;
use Sixincode\HiveAlpha\Traits\HasDataAndProperties;

class HiveUser extends HiveModelMin
{
    use SoftDeletes;
    use HasFactory;
    use GlobalUniqueIdentifierTrait;
    use HasDataAndProperties;

    public function initializeHiveModel()
    {
      $this->casts['created_at'] = 'datetime:d-m-Y';
      $this->casts['updated_at'] = 'datetime:d-m-Y';
      $this->casts['deleted_at'] = 'datetime:d-m-Y';

      // $this->fillable[] = 'slug';
      $this->fillable[] = 'properties';
    }

    protected $orderable = [
        // 'picture',
    ];

    public static function getLocale()
    {
        return app()->getLocale();
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->translatable) && ! is_array($value)) {
            return $this->setTranslation($key, static::getLocale(), $value);
        }

        return parent::setAttribute($key, $value);
    }

}
