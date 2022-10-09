<?php

namespace Sixincode\HiveAlpha\Traits;

use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasDataAndProperties
{
  public function initializeHasDataAndProperties()
  {
    $this->casts['data'] = SchemalessAttributes::class;
    $this->casts['properties'] = SchemalessAttributes::class;
    $this->orderable[] = 'properties';
    $this->filterable[] = 'properties';
  }

  public function scopeWithData(): Builder
  {
     return $this->data->modelScope();
  }

  public function scopeWithProperties(): Builder
  {
     return $this->properties->modelScope();
  }
}
