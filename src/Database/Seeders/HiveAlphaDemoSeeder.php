<?php
namespace Sixincode\HiveAlpha\Database\Seeders;

use Illuminate\Database\Seeder;
use Sixincode\HivePosts\Models\Post;
use Faker\Provider\fr_FR\Text as TextFR;
use Sixincode\HiveHelpers\Traits\FieldsTrait;
use App\Models\User;
use App\Models\Team;
// use Sixincode\HiveCommunity\Models\Team;
// use Sixincode\HiveAlpha\Models\HiveUser as User;

class HiveAlphaDemoSeeder extends Seeder
{
   use FieldsTrait;

   public function run()
   {
      $user = User::factory()
            ->withPersonalTeam()
            ->count(6)
            ->create();

   }
};
