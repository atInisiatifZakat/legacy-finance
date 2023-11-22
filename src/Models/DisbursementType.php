<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Models;

use Illuminate\Database\Eloquent\Model;

final class DisbursementType extends Model
{
    protected $guarded = [];

    protected $casts = [
        'disbursement_category_id' => DisbursementCategory::class,
    ];

    public function getConnectionName(): string
    {
        return \config('finance.connection', parent::getConnectionName());
    }

    public function getTable(): string
    {
        return \config('finance.tables.disbursement_type', parent::getTable());
    }
}
