<?php

namespace Sixincode\HiveAlpha\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sixincode\HiveAlpha\Traits\HiveModelTraits;

class HiveModel extends HiveModelMin
{
    use HasFactory;
    use HiveModelTraits;

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


}
