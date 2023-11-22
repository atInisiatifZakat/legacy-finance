<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Models;

use Illuminate\Database\Eloquent\Model;

final class DisbursementDetail extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function getConnectionName(): string
    {
        return \config('finance.connection', parent::getConnectionName());
    }

    public function getTable(): string
    {
        return \config('finance.tables.disbursement_detail', parent::getTable());
    }
}
