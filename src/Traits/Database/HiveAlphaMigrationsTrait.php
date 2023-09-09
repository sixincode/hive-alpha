<?php

namespace Sixincode\HiveAlpha\Traits\Database;

use Sixincode\HiveAlpha\Database\Migrations as Migrations;

trait HiveAlphaMigrationsTrait
{
  public function migrateUp(): void
  {
    $migration = new Migrations\HiveAlphaTables;
    $migration->up();
    // \HiveCommunity::migrateTeamsUp();
  }

  public function migrateDown(): void
  {
    // \HiveCommunity::migrateTeamsDown();
    $migration = new Migrations\HiveAlphaTables;
    $migration->down();

  }
}
