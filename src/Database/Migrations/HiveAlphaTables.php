<?php
namespace Sixincode\HiveAlpha\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HiveAlphaTables extends Migration
{
    public function up()
    {
      $tableNames  = config('hive-alpha.table_names');
      $columnNames = config('hive-alpha.column_names');

      if (empty($tableNames)) {
        throw new \Exception('Error: config/hive-alpha.php not loaded. Run [php artisan config:clear] and try again.');
      }
      if (empty($columnNames)) {
        throw new \Exception('Error: config/hive-alpha.php not loaded. Run [php artisan config:clear] and try again.');
      }

      if(!Schema::hasTable($tableNames['logins'])) {
        Schema::create($tableNames['logins'], function (Blueprint $table) {
            $table->addLoginFields($table);
        });
      }

      if(Schema::hasTable($tableNames['users'])) {
        Schema::table($tableNames['users'], function (Blueprint $table) {
            $table->dropColumn('name');
            $table->joinAlphaUserFields($table);
        });
      }else{
        Schema::create($tableNames['users'], function (Blueprint $table) {
            $table->addAlphaUserFields($table);
        });
      }

    }

    public function down()
    {
      $tableNames  = config('hive-alpha.table_names');
      $columnNames = config('hive-alpha.column_names');

      if (empty($tableNames)) {
        throw new \Exception('Error: config/hive-alpha.php not loaded. Run [php artisan config:clear] and try again.');
      }
      if (empty($columnNames)) {
        throw new \Exception('Error: config/hive-alpha.php not loaded. Run [php artisan config:clear] and try again.');
      }

      Schema::dropIfExists($tableNames['logins']);

      Schema::table($tableNames['users'], function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn(array_merge([
                'first_name',
                'last_name',
                'username',
                'phone',
                'email',
                'email_verified_at',
                'password',
                'status',
                'remember_token',
                'stripe_id',
                'provider_id',
                'provider_type',
                'current_tenant_id',
                'current_team_id',
                'profile_photo_path',
                'membership_ends_at',
                'type',
                'two_factor_secret',
                'two_factor_recovery_codes',
                'two_factor_confirmed_at',
                'is_featured',
                'is_private',
                'is_active',
                'properties',
                'data',
                'global',
                'is_deleted',
                  ])
                );
        });
    }
};
