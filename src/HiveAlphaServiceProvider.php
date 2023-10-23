<?php

namespace Sixincode\HiveAlpha;

use Sixincode\ModulesInit\Package;
use Sixincode\ModulesInit\PackageServiceProvider;
use Sixincode\HiveAlpha\Commands\HiveAlphaCommand;
use Illuminate\Foundation\Console\AboutCommand;
use Sixincode\HiveAlpha\Traits\Database as DatabaseTraits;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\AliasLoader;

class HiveAlphaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
      $package
          ->name('hive-alpha')
          ->hasConfigFile(['hive-alpha','hive-lang'])
          ->hasViews()
          ->hasMigration('create_hive-alpha_table')
          ->hasCommand(HiveAlphaCommand::class);

      $this->registerHiveAlphaDatabaseMethods();

      AboutCommand::add('Sixin Code Alpha Elements for Laravel', fn () => ['Version' => '1.0.0']);
    }

    public function registeringPackage()
    {
      $loader = AliasLoader::getInstance();
      $loader->alias('HiveUser', 'Sixincode\HiveAlpha\Models\HiveUser');
    }

    private function registerHiveAlphaDatabaseMethods(): void
    {
      Blueprint::macro('addLoginFields', function (Blueprint $table, $properties = []) {
        DatabaseTraits\HiveAlphaDatabaseDefinitions::addLoginFields($table, $properties);
      });

      Blueprint::macro('addAlphaModelFields', function (Blueprint $table, $properties = []) {
        DatabaseTraits\HiveAlphaDatabaseDefinitions::addAlphaModelFields($table, $properties);
      });

      Blueprint::macro('joinAlphaUserFields', function (Blueprint $table, $properties = []) {
        DatabaseTraits\HiveAlphaDatabaseDefinitions::joinAlphaUserFields($table, $properties);
      });

      Blueprint::macro('addAlphaUserFields', function (Blueprint $table, $properties = []) {
        DatabaseTraits\HiveAlphaDatabaseDefinitions::addAlphaUserFields($table, $properties);
      });

    }
}
