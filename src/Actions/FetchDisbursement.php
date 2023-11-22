<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Actions;

use Inisiatif\LegacyFinance\Models\Disbursement;

final class FetchDisbursement
{
    public function handle(Disbursement|string $disbursement): ?Disbursement
    {
        if ($disbursement instanceof Disbursement) {
            return $disbursement->loadMissing(['type', 'details']);
        }

        /** @var Disbursement */
        return Disbursement::query()->with(['type', 'details'])->find($disbursement);
    }
}
