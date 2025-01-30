<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Actions;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Inisiatif\LegacyFinance\Models\Disbursement;

final class SearchDisbursementUsingNumber
{
    public function handle(Request $request): Collection | null
    {
        $searchTerm = $request->string('q')
        ->wrap('%', '%')
        ->toString();

        if($request->query('q')){
            $builder = Disbursement::query()
            ->when($searchTerm, function (Builder $builder) use ($searchTerm): Builder {
                return $builder->where(function (Builder $query) use ($searchTerm): void {
                    /** @psalm-suppress  PossiblyNullArgument */
                    $value = \mb_strtolower($searchTerm, 'UTF8');

                    $query->orWhereRaw('LOWER(disbursement_no) LIKE ? ', "%{$value}%");
                });
            })->with(['type', 'type.category', 'details'])->get();

            return $builder;
        }

        return null;

    }
}
