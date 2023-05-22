<?php

namespace Sixincode\HiveAlpha\Seeders;

use Illuminate\Database\Seeder;
use Sixincode\HivePosts\Models\Post;
use Faker\Provider\fr_FR\Text as TextFR;
use Sixincode\HiveHelpers\Traits\FieldsTrait;
use App\Models\User;
use Sixincode\HiveCommunity\Models\Team;

class HiveAlphaAdminSeeder extends Seeder
{
  use FieldsTrait;

  public function run()
  {
    $faker = \Faker\Factory::create();
    $users = User::all();

    $user  = [
         'first_name' => 'John',
         'last_name' => 'Doe',
         'username' => 'admin',
         'email' => 'admin@admin.com',
         'username' => 'admin',
         // 'terms' => 'on',
         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         // 'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
         'email' => 'admin@admin.com',
         // 'type'           => 1000,
         'global'         => 'user_admin',
     ];

     $admin = User::create($user);
     $admin->ownedTeams()->save(Team::forceCreate([
         'user_id' => $admin->id,
         'name' => $admin->first_name."'s Team",
         'personal_team' => true,
         Team::globalUserFieldName() => $admin->global,

     ]));


  }
}