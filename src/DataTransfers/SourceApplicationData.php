<?php

declare(strict_types=1);

namespace Inisiatif\LegacyFinance\DataTransfers;

use Spatie\LaravelData\Data;

final class SourceApplicationData extends Data
{
    public function __construct(
        public readonly null|string|int $sourceId = null,
        public readonly ?string $sourceName = null,
    ) {}
}
