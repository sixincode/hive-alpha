<?php

namespace Sixincode\HiveAlpha;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Sixincode\HiveAlpha\Commands\HiveAlphaCommand;
use Illuminate\Foundation\Console\AboutCommand;

class HiveAlphaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        public function register(){}

        public function boot(){}

        $package
            ->name('hive-alpha')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_hive-alpha_table')
            ->hasCommand(HiveAlphaCommand::class);

        AboutCommand::add('Sixin Code Alpha Elements for Laravel', fn () => ['Version' => '1.0.0']);

    }
}
