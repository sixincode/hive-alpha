<?php

namespace Sixincode\HiveAlpha\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sixincode\HiveAlpha\HiveAlpha
 */
class HiveAlpha extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Sixincode\HiveAlpha\HiveAlpha::class;
    }
}
