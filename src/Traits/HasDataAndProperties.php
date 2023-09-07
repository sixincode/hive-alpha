<?php

namespace Sixincode\HiveAlpha\Traits;

use Spatie\SchemalessAttributes\Casts\SchemalessAttributes;
use Illuminate\Database\Eloquent\Builder;

trait HasDataAndProperties
{
  public function initializeHasDataAndProperties()
  {
    $this->casts['data'] = SchemalessAttributes::class;
    $this->casts['properties'] = SchemalessAttributes::class;
    $this->orderable[] = 'properties';
    $this->filterable[] = 'properties';
    $this->fillable[] = 'properties';
    $this->fillable[] = 'data';
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
