<?php

namespace Sixincode\HiveAlpha\Traits\Database;

use Sixincode\HiveAlpha\Database\Seeders as Seeders;

trait HiveAlphaSeedersTrait
{
  public function seed(): void
  {
    $this->seedAdmin();
  }

  public function seedAdmin(): void
  {
    $seeder = new Seeders\HiveAlphaAdminSeeder;
    $seeder->run();
  }

  public function seedDemo(): void
  {
    $this->seedAdmin();
    $seeder = new Seeders\HiveAlphaDemoSeeder;
    $seeder->run();
  }
}
