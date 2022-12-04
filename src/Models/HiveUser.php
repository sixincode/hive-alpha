<?php

namespace Sixincode\HiveAlpha\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sixincode\HiveAlpha\Traits\GlobalUniqueIdentifierTrait;
use Sixincode\HiveAlpha\Traits\HasDataAndProperties;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Sixincode\HiveCommunity\Traits\HasTeams;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class HiveUser extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use HasFactory;
    use GlobalUniqueIdentifierTrait;
    use HasDataAndProperties;
    use HasTeams;
    use Notifiable;

    public function initializeHiveUser()
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
    protected $filterable = [
        // 'picture',
    ];

    public static function getLocale()
    {
        return app()->getLocale();
    }



}
