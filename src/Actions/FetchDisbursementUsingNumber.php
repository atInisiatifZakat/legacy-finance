<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Actions;

use Inisiatif\LegacyFinance\Models\Disbursement;

final class FetchDisbursementUsingNumber
{
    public function handle(string $disbursementNo): Disbursement
    {
        $builder = Disbursement::query()
            ->where('disbursement_no', $disbursementNo)
            ->with(['type', 'type.category', 'details'])->first();

        return $builder;
    }
}
