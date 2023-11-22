<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Disbursement extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'metadata' => 'array',
        'advances_used_date' => 'array',
    ];

    public function getConnectionName(): string
    {
        return \config('finance.connection', parent::getConnectionName());
    }

    public function getTable(): string
    {
        return \config('finance.tables.disbursement', parent::getTable());
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(DisbursementType::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(DisbursementDetail::class);
    }

    public static function createNew(array $attributes, array $metadata = []): self
    {
        /** @var self */
        return self::query()->create([
            ...$attributes,
            'cash_bank_id' => null,
            'note' => null,
            'project_id' => null,
            'company_id' => 2,
            'status_id' => 3,
            'transaction_date' => null,
            'batch_id' => null,
            'daf_trans_no' => null,
            'currency_code' => '000',
            'exchange_rate' => 1,
            'total_amount_eqv' => $attributes['total_amount'],
            'payment_to' => null,
            'is_real' => true,
            'metadata' => $metadata,
        ]);
    }
}
