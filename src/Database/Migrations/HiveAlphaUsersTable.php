<?php

namespace Sixincode\HiveAlpha\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Sixincode\HiveAlpha\Traits\HiveAlphaDatabase;

class HiveAlphaUsersTable
{
  public static function up()
  {
      Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('name');
        $table->string('first_name')->after('id');
        $table->string('last_name')->after('first_name');
        $table->string('username')->after('last_name');
        $table->string('phone')->after('email');
        $table->tinyInteger('status')->default(0)->after('phone');
        $table->foreignId('current_tenant_id')->nullable();
        $table->string('provider_id')->unique()->nullable();
        $table->string('provider_type')->nullable();
        $table->string('stripe_id')->unique()->nullable();
        $table->isPrivateField();
        $table->globalField()
        $table->propertiesSchemaField();
        $table->dataSchemaField();
        $table->softDeletes();

      });
  }

  public static function down()
  {
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('first_name');
        $table->dropColumn('last_name');
        $table->dropColumn('username');
        $table->dropColumn('phone');
        $table->dropColumn('status');
        $table->dropColumn('properties');
        $table->dropColumn('data');
        $table->dropColumn('is_public');
        $table->dropColumn('global');
        $table->dropColumn('is_deleted');
        $table->string('name')->after('id');
      });
   }
