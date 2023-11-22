<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Actions;

use Illuminate\Support\Collection;
use Inisiatif\LegacyFinance\Models\Disbursement;
use Inisiatif\LegacyFinance\DataTransfers\SourceApplicationData;

final class FetchDisbursementUsingSource
{
    public function handle(SourceApplicationData $data): Collection
    {
        $builder = Disbursement::query()->with(['type', 'details']);

        if ($data->sourceName) {
            $builder->where('metadata->app', $data->sourceName);
        }

        if ($data->sourceId) {
            $builder->where('metadata->app_reff_id', $data->sourceId);
        }

        /** @var Collection */
        return $builder->get();
    }
}
