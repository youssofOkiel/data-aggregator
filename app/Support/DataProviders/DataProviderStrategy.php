<?php

namespace App\Support\DataProviders;

interface DataProviderStrategy
{
    public static function map(array $data): array;
}
