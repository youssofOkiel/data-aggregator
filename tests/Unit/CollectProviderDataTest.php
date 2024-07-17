<?php

use App\Enums\DataProviderType;
use App\Jobs\StoreProvidersData;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Queue;

use function Pest\Laravel\artisan;

beforeEach(function () {
    Queue::fake();

    Artisan::call('db:seed');
});

it('test that collect-data command', function () {
    artisan('provider:collect-data')
        ->expectsChoice('Select data provider:', 'data_provider_x', DataProviderType::getValues())
        ->expectsQuestion('Enter data provider file name:', 'DataProviderX.json');

});

it('test that the StoreProvidersData job is dispatched', function () {
    artisan('provider:collect-data')
        ->expectsChoice('Select data provider:', 'data_provider_x', DataProviderType::getValues())
        ->expectsQuestion('Enter data provider file name:', 'DataProviderX.json');

    Queue::assertPushed(StoreProvidersData::class);

});
