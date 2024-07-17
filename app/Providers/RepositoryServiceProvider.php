<?php

namespace App\Providers;

use App\Repositories\Contracts\TransactionRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\EloquentTransactionRepository;
use App\Repositories\Eloquent\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $binds = [
            TransactionRepository::class => EloquentTransactionRepository::class,
            UserRepository::class => EloquentUserRepository::class,
        ];

        foreach ($binds as $contract => $class) {
            $this->app->bind($contract, $class);
        }
    }
}
