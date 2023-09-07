<?php
namespace Sixincode\HiveAlpha\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HiveAlphaEditUserTable extends Migration
{    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->addAlphaUserFields();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->string('name');
        $table->dropColumn(array_merge([
            'first_name',
            'last_name',
            'username',
            'phone',
            'provider_id',
            'provider_type',
            'membership_ends_at',
            'type',
            'global',
            'is_featured',
            'is_private',
            'is_active',
            'is_deleted',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'two_factor_confirmed_at',
              ])
            );
        });
    }
};
