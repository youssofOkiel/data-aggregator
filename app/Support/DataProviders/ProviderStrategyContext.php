<?php

namespace App\Support\DataProviders;

use App\Enums\DataProviderType;
use App\Support\DataProviders\Strategies\DataProviderXStrategy;
use App\Support\DataProviders\Strategies\DataProviderYStrategy;

class ProviderStrategyContext
{
    private DataProviderStrategy $strategy;

    public function __construct($strategy)
    {
        $this->strategy = match ($strategy) {
            DataProviderType::DataProviderX => new DataProviderXStrategy(),
            DataProviderType::DataProviderY => new DataProviderYStrategy(),
            default => throw new \Exception('Invalid provider name'),
        };
    }

    public function map(array $data): array
    {
        return $this->strategy->map($data);
    }
}
