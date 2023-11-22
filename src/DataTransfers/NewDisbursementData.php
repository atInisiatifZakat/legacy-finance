<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\DataTransfers;

use DateTime;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\DataCollectionOf;

#[MapName(SnakeCaseMapper::class)]
final class NewDisbursementData extends Data
{
    public function __construct(
        public readonly int $employeeId,
        public readonly int $branchId,
        public readonly string $description,
        public readonly string $disbursementTypeId,
        public readonly DateTime $requestDate,
        public readonly float $totalAmount,

        #[DataCollectionOf(DisbursementItemData::class)]
        public readonly DataCollection $items,
        public readonly string $paymentType,

        #[MapOutputName('to_bank_name')]
        public readonly ?string $bankName = '',

        #[MapOutputName('to_account_name')]
        public readonly ?string $accountName = '',

        #[MapOutputName('to_account_no')]
        public readonly ?string $accountNumber = '',
        public readonly string|int|null $reffId = null,
        public readonly ?array $advancesUsedDate = null,
        public readonly ?SourceApplicationData $app = null,
    ) {
    }
}
