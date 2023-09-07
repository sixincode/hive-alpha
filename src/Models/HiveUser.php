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
use Sixincode\HiveCommunity\Traits as HiveCommunityTraits;
use Sixincode\HiveCalendar\Traits as HiveCalendarTraits;

class HiveUser extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes;
    use HasFactory;
    use Notifiable;
    use HiveAlphaTraits\GlobalUniqueIdentifierTrait;
    use HiveAlphaTraits\HasDataAndProperties;
    use HiveCommunityTraits\HasTeams;
    use HiveStreamTraits\HasSettings;
    use HiveStreamTraits\HasSubscriptionPlan;
    use HiveStreamTraits\HiveStreamUser;
    use HiveCalendarTraits\HasEventsTrait;

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

    public function validateUser()
    {
        $this->setUserSettings();
    }



}
