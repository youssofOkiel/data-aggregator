<?php

use App\Enums\DataProviderType;
use App\Jobs\StoreProvidersData;
use App\Models\Transaction;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;

use function Pest\Laravel\artisan;

beforeEach(function () {
    Artisan::call('db:seed');
});

it('test that collect-data provider x from command ', function () {
    artisan('provider:collect-data')
        ->expectsChoice('Select data provider:', DataProviderType::DataProviderX, DataProviderType::getValues())
        ->expectsQuestion('Enter data provider file name:', 'DataProviderX.json')
        ->expectsOutput('Storing data from ' . DataProviderType::DataProviderX . ' in progress...');
});

it('test that collect-data provider y command ', function () {
    artisan('provider:collect-data')
        ->expectsChoice('Select data provider:', DataProviderType::DataProviderY, DataProviderType::getValues())
        ->expectsQuestion('Enter data provider file name:', 'DataProviderY.json')
        ->expectsOutput('Storing data from ' . DataProviderType::DataProviderY . ' in progress...');
});

it('test that collect-data provider y not file found ', function () {
    artisan('provider:collect-data')
        ->expectsChoice('Select data provider:', DataProviderType::DataProviderY, DataProviderType::getValues())
        ->expectsQuestion('Enter data provider file name:', 'DataProviderXYZ.json')
        ->expectsOutput('File not found.');
});

it('test that the StoreProvidersData job is dispatched', function () {
    Queue::fake();
    artisan('provider:collect-data')
        ->expectsChoice('Select data provider:', DataProviderType::DataProviderX, DataProviderType::getValues())
        ->expectsQuestion('Enter data provider file name:', 'DataProviderX.json');

    Queue::assertPushed(StoreProvidersData::class);
});

it('test that the StoreProvidersData job create transactions', function () {
    artisan('provider:collect-data')
        ->expectsChoice('Select data provider:', DataProviderType::DataProviderX, DataProviderType::getValues())
        ->expectsQuestion('Enter data provider file name:', 'DataProviderX.json');

    expect(Transaction::count())->toBeGreaterThan(0);
});
