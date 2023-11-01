<?php

namespace Sixincode\HiveAlpha\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Sixincode\HiveAlpha\Traits as HiveAlphaTraits;
use Sixincode\HiveStream\Traits as HiveStreamTraits;
// use Sixincode\HiveCommunity\Traits as HiveCommunityTraits;
// use Sixincode\HiveCalendar\Traits as HiveCalendarTraits;

class HiveUser extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use HasFactory;
    use Notifiable;
    use HiveAlphaTraits\GlobalUniqueIdentifierTrait;
    use HiveAlphaTraits\HasDataAndProperties;
    // use HiveCommunityTraits\HasTeams;
    use HiveStreamTraits\HasSettings;
    use HiveStreamTraits\HasSubscriptionPlan;
    use HiveStreamTraits\HiveStreamUser;
    // use HiveCalendarTraits\HasEventsTrait;

    public function initializeHiveUser()
    {
      $this->casts['created_at'] = 'datetime:d-m-Y';
      $this->casts['updated_at'] = 'datetime:d-m-Y';
      $this->casts['deleted_at'] = 'datetime:d-m-Y';

      $this->appends[] = 'name';

      // $this->fillable[] = 'slug';
      // $this->fillable[] = 'properties';
    }

    protected $appends = [
        // 'picture',
    ];

    protected $orderable = [
        // 'picture',
    ];
    protected $filterable = [
        // 'picture',
    ];

    public function getIdKey()
    {
        return $this->id;
    }

    public static function getLocale()
    {
        return app()->getLocale();
    }

    public function validateUser()
    {
        $this->setUserSettings();
    }

    public function getNameAttribute()
    {
        return $this->first_name.''.$this->last_name;
    }

    public function getProfileAttributes()
    {
        return [
          'first_name' => $this->first_name,
          'last_name'  => $this->last_name,
          'username'   => $this->username,
          'email'      => $this->email,
          'phone'      => $this->phone,
          'email'      => $this->email,
        ];
    }

    public function mainAdmin()
    {
        return $this->first_name.''.$this->last_name;
    }

}
