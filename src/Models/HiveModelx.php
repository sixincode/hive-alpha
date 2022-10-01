<?php

namespace Sixincode\HiveAlpha\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;

class HiveModelx extends Model
{
    $this->casts['properties'] = SchemalessAttributes::class;
}
