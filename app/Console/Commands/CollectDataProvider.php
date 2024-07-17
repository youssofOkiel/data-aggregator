<?php

namespace App\Console\Commands;

use App\Enums\DataProviderType;
use App\Jobs\StoreProvidersData;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class CollectDataProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'provider:collect-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dataProviderName = select(
            label: 'Select data provider:',
            options: DataProviderType::getValues(),
            required: true
        );

        $dataProviderFileName = text(
            label: 'Enter data provider file name:',
            placeholder: 'ex: DataProviderX.json',
            hint: 'This will fetch data from the specified file in storage.',
            required: true
        );

        $providerFile = storage_path('data-providers/'.$dataProviderFileName);

        if (! file_exists($providerFile)) {
            $this->error('File not found.');
        } else {

            collect(File::json($providerFile))
                ->chunk(1000)
                ->each(fn (Collection $transactions) => StoreProvidersData::dispatch($transactions, $dataProviderName));

            $this->info('Data fetched successfully.');
        }
    }
}
