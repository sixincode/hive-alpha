<?php

namespace Sixincode\HiveAlpha\Traits\Database;

use Sixincode\HiveAlpha\Database\Migrations as Migrations;

trait HiveAlphaMigrationsTrait
{
  public function migrateUp(): void
  {
    Migrations\HiveAlphaTables::up();
  }

  public function migrateDown(): void
  {
    Migrations\HiveAlphaTables::down();
  }
}
