<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\Actions;

use Illuminate\Support\Facades\DB;
use Inisiatif\LegacyFinance\Enums;
use Inisiatif\LegacyFinance\Models\Disbursement;
use Inisiatif\LegacyFinance\Models\DisbursementType;
use Inisiatif\LegacyFinance\Models\DisbursementCategory;
use Inisiatif\LegacyFinance\DataTransfers\NewDisbursementData;
use Inisiatif\LegacyFinance\DataTransfers\DisbursementItemData;

final class StoreNewDisbursement
{
    public function handle(NewDisbursementData $data): Disbursement
    {
        /** @var DisbursementType $type */
        $type = DisbursementType::query()->find($data->disbursementTypeId);

        /** @var Disbursement|null $um */
        $um = Disbursement::query()->find($data->reffId);

        $disbursementNumber = $this->generateNumber(
            Enums\DisbursementCategory::from((int) $type->getAttribute('disbursement_category_id')), $um
        );

        return DB::transaction(static function () use ($data, $disbursementNumber): Disbursement {
            $disbursement = Disbursement::createNew(
                [
                    ...$data->except('app', 'items', 'bankName', 'accountName', 'accountNumber')->toArray(),
                    'disbursement_no' => $disbursementNumber,
                ],
                [
                    'to_bank_name' => $data->bankName,
                    'to_account_name' => $data->accountName,
                    'to_account_no' => $data->accountNumber,
                    'pc_reff_id' => null,
                    'checklist' => null,
                    'app' => $data->app?->sourceName,
                    'link' => null,
                    'payee_id' => null,
                    'payment_date' => null,
                    'has_transaction' => 0,
                    'payment_status' => 0,
                    'app_reff_id' => $data->app?->sourceId,
                    'po_id' => null,
                ]
            );

            $data->items->each(static function (DisbursementItemData $data) use ($disbursement): void {
                $disbursement->details()->create([
                    ...$data->toArray(),
                    'subtotal' => $data->quantity * $data->amount,
                    'amount_eqv' => $data->amount,
                    'subtotal_eqv' => $data->quantity * $data->amount,
                ]);
            });

            return $disbursement;
        });
    }

    private function getLastSequenceNumber(Enums\DisbursementCategory $category): string
    {
        $builder = DisbursementCategory::query()->where('id', $category->value);

        $builder->increment('last_no_izi');

        /** @var DisbursementCategory|null $model */
        $model = $builder->first();

        return $model?->getLastSequenceNumber() ?? '0';
    }

    private function generateNumber(Enums\DisbursementCategory $category, Disbursement $um = null): string
    {
        if ($um) {
            /** @var string */
            return \str_replace(['UM', 'RM'], ['LPJ', 'LPJ'], $um->getAttribute('disbursement_no'));
        }

        $lastNumber = \str_pad($this->getLastSequenceNumber($category), 7, '0', STR_PAD_LEFT);

        $suffix = $category === Enums\DisbursementCategory::rm ? 'RM' : 'UM';

        // TODO : `001` harusnya ambil dari branch
        return \sprintf('%s-%s-%s-%s', $suffix, now()->year, '001', $lastNumber);
    }
}
