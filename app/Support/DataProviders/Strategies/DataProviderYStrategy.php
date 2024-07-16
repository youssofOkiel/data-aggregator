<?php

namespace App\Support\DataProviders\Strategies;

use App\Support\DataProviders\DataProviderStrategy;
use Illuminate\Support\Carbon;

class DataProviderYStrategy implements DataProviderStrategy
{
    public static function map(array $data): array
    {
        $createdAt = Carbon::createFromFormat('d/m/Y', $data['created_at']);

        return [
            'amount' => $data['balance'],
            'currency' => $data['currency'],
            'user_email' => $data['email'],
            'status' => $data['status'],
            'date' => $createdAt->toDate(),
            'identification' => $data['id'],
        ];
    }
}
