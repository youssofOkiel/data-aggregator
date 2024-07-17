<?php

namespace App\Repositories\Eloquent;

use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepository;
use App\Repositories\RepositoryAbstract;

class EloquentTransactionRepository extends RepositoryAbstract implements TransactionRepository
{
    public function model(): string
    {
        return Transaction::class;
    }
}
