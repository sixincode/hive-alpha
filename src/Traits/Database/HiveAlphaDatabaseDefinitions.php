<?php

namespace Sixincode\HiveAlpha\Traits\Database;

use Illuminate\Database\Schema\Blueprint;
use Sixincode\HiveHelpers\Traits\FieldsTrait;

trait HiveAlphaDatabaseDefinitions
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
    $table->id();
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->rememberToken();
    $table->foreignId('current_team_id')->nullable();
    $table->string('profile_photo_path', 2048)->nullable();
    $table->timestamps();
    $table->joinAlphaUserFields();
  }

  public static function joinAlphaUserFields(Blueprint $table): void
  {
    $table->after('id', function (Blueprint $table) {
      $table->string('first_name');
      $table->string('last_name');
    });

    $table->after('email', function (Blueprint $table) {
      $table->string('username')->unique();
      $table->string('phone')->unique()->nullable();
      $table->tinyInteger('status')->default(0);
      $table->string('stripe_id')->unique()->nullable();
      $table->string('provider_id')->unique()->nullable();
      $table->string('provider_type')->nullable();
      $table->foreignId('current_tenant_id')->nullable();
      $table->integer('membership_ends_at')->nullable();
      $table->integer('type')->default(3000);

      if(table_has_column(check_tableUsers(),'two_factor_secret')){
        $table->text('two_factor_secret')->nullable();
      }
      if(table_has_column(check_tableUsers(),'two_factor_recovery_codes')){
        $table->text('two_factor_recovery_codes')->nullable();
      }
      if(table_has_column(check_tableUsers(),'two_factor_confirmed_at')){
        $table->text('two_factor_confirmed_at')->nullable();
      }

    });

    $table->after('remember_token', function (Blueprint $table) {
      $table->isFeaturedField();
      $table->isPrivateField();
      $table->isActiveField();
      $table->propertiesSchemaField();
      $table->dataSchemaField();
      $table->globalField();
      $table->softDeletes();
    });
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
}
