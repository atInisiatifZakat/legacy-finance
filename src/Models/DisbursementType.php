<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class DisbursementType extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'disbursement_category_id' => 'string',
    ];

    public function getConnectionName(): string
    {
        return \config('finance.connection', parent::getConnectionName());
    }

    public function getTable(): string
    {
        return \config('finance.tables.disbursement_type', parent::getTable());
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(DisbursementCategory::class, 'disbursement_category_id');
    }
}
