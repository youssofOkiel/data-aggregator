<?php

namespace App\Enums;

enum DataProviderType: string
{
    case DataProviderX = 'data_provider_x';
    case DataProviderY = 'data_provider_y';

    public static function toArray(): array
    {
        return collect(self::cases())
            ->map(fn ($value) => $value->value)
            ->toArray();
    }
}
