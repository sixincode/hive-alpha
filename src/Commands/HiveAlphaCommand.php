<?php

namespace Sixincode\HiveAlpha\Commands;

use Illuminate\Console\Command;

class HiveAlphaCommand extends Command
{
    public $signature = 'hive-alpha';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
