<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @internal
 */
final class Branch extends Model
{
    public function getConnectionName(): string
    {
        return \config('finance.connection', parent::getConnectionName());
    }

    public function getTable(): string
    {
        return \config('finance.tables.branch', parent::getTable());
    }
}
