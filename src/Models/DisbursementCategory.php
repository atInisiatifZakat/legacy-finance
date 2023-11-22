<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Models;

use Illuminate\Database\Eloquent\Model;

final class DisbursementCategory extends Model
{
    public $timestamps = false;
    
    protected $guarded = [];

    protected $casts = [
        'last_no_izi' => 'string',
    ];

    public function getConnectionName(): string
    {
        return \config('finance.connection', parent::getConnectionName());
    }

    public function getTable(): string
    {
        return \config('finance.tables.disbursement_category', parent::getTable());
    }

    public function getLastSequenceNumber(): string
    {
        /** @var string|null $lastNumber */
        $lastNumber = $this->getAttribute('last_no_izi');

        return $lastNumber ?? '0';
    }
}
