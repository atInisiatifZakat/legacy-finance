<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Inisiatif\LegacyFinance\LegacyFinanceServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            LegacyFinanceServiceProvider::class,
        ];
    }
}
