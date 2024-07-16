<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Support\DataTransferObjects\TransactionDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class StoreProvidersData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Collection $transactions, private string $providerName)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->transactions as $transaction) {
            $transaction = TransactionDto::fromArray($this->providerName, $transaction);

            Transaction::create([
                ...$transaction->toArray(),
                'provider' => $this->providerName,
            ]);
        }
    }
}
