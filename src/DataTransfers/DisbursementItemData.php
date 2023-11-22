<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\DataTransfers;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
final class DisbursementItemData extends Data
{
    public function __construct(
        public readonly string|int $budgetId,
        public readonly string $description,
        public readonly int $quantity,
        public readonly float|int $amount
    ) {
    }
}
