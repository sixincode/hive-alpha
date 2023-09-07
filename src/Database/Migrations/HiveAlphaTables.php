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
        Schema::create('logins', function (Blueprint $table) {
            $table->addLoginFields();
        });
      }

      if(Schema::hasTable($tableNames['users'])) {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->addAlphaUserFields()->unique();
        });
      }else{
        Schema::create('users', function (Blueprint $table) {
            $table->addAlphaUserFields()->unique();
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

      Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('stripe_id');
            $table->dropColumn('current_tenant_id');
            $table->dropColumn('current_team_id');
            $table->dropColumn('profile_photo_path');
            $table->dropColumn('membership_ends_at');
            $table->dropColumn('type');
            $table->dropColumn('global');
        });
    }
};
