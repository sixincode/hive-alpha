<?php

namespace Sixincode\HiveAlpha\Models;

use Illuminate\Database\Eloquent\HiveModelMin;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class HiveModelx extends HiveModelMin
{
  public function __construct()
  {
    $this->casts['properties'] = SchemalessAttributes::class;

  }

}
