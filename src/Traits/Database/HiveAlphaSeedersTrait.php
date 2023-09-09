<?php

namespace Sixincode\HiveAlpha\Traits\Database;

use Sixincode\HiveAlpha\Database\Seeders as Seeders;

trait HiveAlphaSeedersTrait
{
  public function seedAdmin(): void
  {
    $seeder = new Seeders\HiveAlphaAdminSeeder;
    $seeder->run();
  }
}
