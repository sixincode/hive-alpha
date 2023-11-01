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

}
