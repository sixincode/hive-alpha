<?php

namespace Sixincode\HiveAlpha;

use Sixincode\ModulesInit\Package;
use Sixincode\ModulesInit\PackageServiceProvider;
use Sixincode\HiveAlpha\Commands\HiveAlphaCommand;
use Illuminate\Foundation\Console\AboutCommand;

class HiveAlphaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
      $package
          ->name('hive-alpha')
          ->hasConfigFile(['hive-alpha','hive-lang'])
          ->hasViews()
          // ->hasMigration('create_hive-alpha_table')
          ->hasCommand(HiveAlphaCommand::class);

        AboutCommand::add('Sixin Code Alpha Elements for Laravel', fn () => ['Version' => '1.0.0']);

    }
}
