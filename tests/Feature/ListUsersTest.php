<?php

use App\Enums\DataProviderType;
use App\Enums\TransactionXStatus;
use App\Models\Transaction;

use function Pest\Laravel\get;

beforeEach(function () {
    Transaction::factory()->count(500)->create();
});

it('returns a successful response', function () {
    $response = $this->get(route('users.index'));

    $response->assertStatus(200);
});

it('returns a list of users', function () {
    get(route('users.index'))
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'email',
                    'transactions',
                ],
            ],
        ]);
});

it('returns a list of users with transactions', function () {
    get(route('users.index'))
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'transactions' => [
                        '*' => [
                            'id',
                            'amount',
                            'currency',
                            'status',
                            'provider',
                        ],
                    ],
                ],
            ],
        ]);
});

it('returns a list of users with transactions filtered by provider', function ($provider) {
    $response = get(route('users.index', ['provider' => $provider]));

    $providerExists = true;
    collect($response->json('data'))->each(function ($user) use (&$providerExists, $provider) {
        $providerExists = collect($user['transactions'])->contains('provider', $provider);
    });

    $this->assertTrue($providerExists);
})->with(DataProviderType::getValues());

it('returns a list of users with transactions filtered by provider and status code', function ($statusCode) {

    $response = get(route('users.index', [
        'statusCode' => $statusCode,
        'provider' => DataProviderType::DataProviderX,
    ]));

    $statusExists = true;
    collect($response->json('data'))->each(function ($user) use (&$statusExists, $statusCode) {
        $statusExists = collect($user['transactions'])->contains('status', TransactionXStatus::fromKey($statusCode)->value);
    });

    $this->assertTrue($statusExists);

})->with(['authorised', 'decline', 'refunded']);

it('returns a list of users with transactions filtered by balance min', function () {
    $response = $this->get(route('users.index', ['balanceMin' => 100]));

    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'transactions' => [
                    '*' => [
                        'amount',
                    ],
                ],
            ],
        ],
    ]);
});

it('returns a list of users with transactions filtered by balance max', function () {
    $response = $this->get(route('users.index', ['balanceMax' => 100]));

    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'transactions' => [
                    '*' => [
                        'amount',
                    ],
                ],
            ],
        ],
    ]);
});

it('returns a list of users with transactions filtered by currency', function () {
    $response = $this->get(route('users.index', ['currency' => 'USD']));

    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'transactions' => [
                    '*' => [
                        'currency',
                    ],
                ],
            ],
        ],
    ]);
});

it('returns a list of users with transactions filtered by provider, status code, balance min, balance max, and currency', function () {
    $response = $this->get(route('users.index', [
        'provider' => DataProviderType::DataProviderX,
        'statusCode' => 'authorised',
        'balanceMin' => 100,
        'balanceMax' => 1000,
        'currency' => 'USD',
    ]));

    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'transactions' => [
                    '*' => [
                        'provider',
                        'status',
                        'amount',
                        'currency',
                    ],
                ],
            ],
        ],
    ]);
});
