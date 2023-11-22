<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Inisiatif\LegacyFinance\Models\Branch;
use Inisiatif\LegacyFinance\Models\Employee;
use Illuminate\Http\Resources\Json\JsonResource;
use Inisiatif\LegacyFinance\Models\Disbursement;
use Inisiatif\LegacyFinance\Models\DisbursementType;
use Inisiatif\LegacyFinance\Actions\FetchDisbursement;
use Inisiatif\LegacyFinance\Actions\StoreNewDisbursement;
use Inisiatif\LegacyFinance\DataTransfers\NewDisbursementData;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Inisiatif\LegacyFinance\DataTransfers\DisbursementItemData;
use Inisiatif\LegacyFinance\DataTransfers\SourceApplicationData;
use Inisiatif\LegacyFinance\Actions\FetchDisbursementUsingSource;

final class DisbursementController
{
    public function index(Request $request, FetchDisbursementUsingSource $disbursementUsingSource): AnonymousResourceCollection
    {
        return JsonResource::collection(
            $disbursementUsingSource->handle(
                SourceApplicationData::from([
                    'sourceId' => $request->get('source_id', ''),
                    'sourceName' => $request->get('source_name', ''),
                ])
            )
        );
    }

    public function store(Request $request, StoreNewDisbursement $newDisbursement): JsonResponse
    {
        $data = $request->validate([
            'description' => ['required'],
            'employee_id' => ['required', Rule::exists(Employee::class, 'id')],
            'branch_id' => ['required', Rule::exists(Branch::class, 'id')],
            'disbursement_type_id' => ['required', Rule::exists(DisbursementType::class, 'id')],
            'request_date' => ['required', 'date'],
            'total_amount' => ['required', 'numeric'],
            'payment_type' => ['required', 'in:transfer,tunai'],
            'bank_name' => ['nullable'],
            'account_name' => ['nullable'],
            'account_number' => ['nullable'],
            'reff_id' => ['nullable', Rule::exists(Disbursement::class, 'id')],
            'advances_used_date' => ['required', 'array'],
            'items' => ['required', 'array'],
            'items.*.budget_id' => ['required'],
            'items.*.description' => ['required'],
            'items.*.quantity' => ['required'],
            'items.*.amount' => ['required'],
        ]);

        $newDisbursement->handle(
            NewDisbursementData::from([
                ...$data,
                'app' => SourceApplicationData::from([
                    'sourceId' => $request->get('source_id', ''),
                    'sourceName' => $request->get('source_name', ''),
                ]),
                'items' => DisbursementItemData::collection(
                    $request->input('items')
                ),
            ])
        );

        return new JsonResponse(null, 204);
    }

    public function show(Disbursement $disbursement, FetchDisbursement $fetchDisbursement): JsonResource
    {
        return JsonResource::make(
            $fetchDisbursement->handle($disbursement)
        );
    }
}
