<?php

namespace App\Support\DataProviders\Strategies;

use App\Support\DataProviders\DataProviderStrategy;
use Illuminate\Support\Carbon;

class DataProviderXStrategy implements DataProviderStrategy
{
    public static function map(array $data): array
    {
        $registerationDate = Carbon::createFromFormat('Y-m-d', $data['registerationDate']);

        return [
            'amount' => $data['parentAmount'],
            'currency' => $data['Currency'],
            'user_email' => $data['parentEmail'],
            'status' => $data['statusCode'],
            'date' => $registerationDate->toDate(),
            'identification' => $data['parentIdentification'],
        ];
    }
}
