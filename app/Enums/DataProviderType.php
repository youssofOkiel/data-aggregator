<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DataProviderType extends Enum
{
    const DataProviderX = 'data_provider_x';

    const DataProviderY = 'data_provider_y';

    public static function getProviderTransactionStatusClass(string $provider): string
    {
        return match ($provider) {
            self::DataProviderX => TransactionXStatus::class,
            self::DataProviderY => TransactionYStatus::class,
            default => throw new \Exception('Invalid provider name'),
        };
    }
}
