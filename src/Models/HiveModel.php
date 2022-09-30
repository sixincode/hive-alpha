<?php

namespace Sixincode\HiveAlpha\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sixincode\HiveAlpha\Traits\GlobalUniqueIdentifierTrait;
use Sixincode\HiveAlpha\Traits\HasDataAndProperties;
use Sixincode\HiveAlpha\Traits\HasUserOwning;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class HiveModel extends Model
{
    use SoftDeletes;
    use HasFactory;
    use GlobalUniqueIdentifierTrait;
    use HasDataAndProperties;
    use HasUserOwning;
    use HasSlug;
    use HasTranslations;

    $this->casts['created_at'] = 'datetime:d-m-Y';
    $this->casts['updated_at'] = 'datetime:d-m-Y';
    $this->casts['deleted_at'] = 'datetime:d-m-Y';

    $this->fillable['slug'];
    $this->fillable['user_global'];
    $this->fillable['properties'];

    public function getRouteKeyName()
    {
        return 'slug';
    }


}
