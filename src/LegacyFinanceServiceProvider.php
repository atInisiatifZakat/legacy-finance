<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class LegacyFinanceServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('finance')->hasConfigFile();
    }
}
