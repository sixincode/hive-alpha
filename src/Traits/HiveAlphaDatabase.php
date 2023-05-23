<?php

namespace Sixincode\HiveAlpha\Traits;

use Illuminate\Database\Schema\Blueprint;
use Sixincode\HiveHelpers\Traits\FieldsTrait;
use Sixincode\HiveAlpha\Database\Seeders\HiveAlphaAdminSeeder;
use Sixincode\HiveAlpha\Database\Migrations\HiveAlphaUsersTable;

trait HiveAlphaDatabase
{
  use FieldsTrait;

  public static function addAlphaModelFields(
    Blueprint $table ,
    $properties = [
      'id'   => 'id',
      'name' => 'name',
      'description' => 'description',
    ],
    ): void
  {
    // dd($properties);
    if(! array_key_exists('id', $properties) || isset($properties['id'] )){
      $table->id();
    }
    $table->slugField();

    if(! array_key_exists('name', $properties) || isset($properties['name'] )){
        $table->descriptionFieldJson($properties['name'] ?? 'name');
    }

    if(! array_key_exists('description', $properties) || isset($properties['description'] )){
        $table->descriptionFieldJson($properties['description'] ?? 'description');
    }

    $table->globalUserField();
    $table->propertiesSchemaField();
    $table->dataSchemaField();
    $table->globalField();
    $table->softDeletes();
    $table->timestamps();
  }

  public static function addAlphaUserFields(Blueprint $table): void
  {
    // $table->dropColumn('name');
    $table->id();
    $table->string('first_name');
    $table->string('last_name');
    $table->string('username')->unique();
    $table->string('phone')->unique()->nullable();
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->string('stripe_id')->unique()->nullable();
    $table->string('provider_id')->unique()->nullable();
    $table->string('provider_type')->nullable();
    $table->foreignId('current_tenant_id')->nullable();
    $table->foreignId('current_team_id')->nullable();
    $table->string('profile_photo_path', 2048)->nullable();
    $table->integer('membership_ends_at')->nullable();
    $table->integer('type')->default(3000);
    $table->text('two_factor_secret')->nullable();
    $table->text('two_factor_recovery_codes')->nullable();
    $table->timestamp('two_factor_confirmed_at')->nullable();
    $table->isFeaturedField();
    $table->isPrivateField();
    $table->isActiveField();
    $table->propertiesSchemaField();
    $table->dataSchemaField();
    $table->globalField();
    $table->softDeletes();
    $table->timestamps();
  }

  public static function addLoginFields(
   Blueprint $table,
   $properties = []
   ): void
  {
    if(! array_key_exists('id', $properties) || isset($properties['id'] )){
      $table->id();
    }
    $table->isActiveField();
    $table->sortOrderField();
    $table->globalUserField();
    $table->propertiesSchemaField();
    $table->dataSchemaField();
    $table->globalField();
    $table->timestamps();
  }

  public function seedAdmin()
  {
    $seeder = new HiveAlphaAdminSeeder;
    return $seeder->run();
  }

  public function migrateUp()
  {
    HiveAlphaUsersTable::up();
    \HiveCommunity::migrateTeamsUp();
  }

  public function migrateDown()
  {
    \HiveCommunity::migrateTeamsDown();
    HiveAlphaUsersTable::down();
  }

}
