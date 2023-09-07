<?php

namespace Sixincode\HiveAlpha;

use Sixincode\HiveAlpha\Traits\Database as DatabaseTrait;

class HiveAlpha
{
  use DatabaseTrait\HiveAlphaMigrationsTrait;
  use DatabaseTrait\HiveAlphaSeedersTrait;

}
