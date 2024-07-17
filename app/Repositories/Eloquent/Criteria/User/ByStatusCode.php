<?php

namespace App\Repositories\Eloquent\Criteria\User;

use App\Enums\DataProviderType;
use App\Enums\TransactionXStatus;
use App\Enums\TransactionYStatus;
use App\Repositories\Criteria\CriterionInterface;

class ByStatusCode implements CriterionInterface
{
    public function __construct(protected ?string $statusCode, protected ?string $provider = null) {}

    public function apply($model)
    {
        return $model->when($this->statusCode, function ($query) {
            return $query->whereHas('transactions', function ($query) {

                $query->whereIn('status', $this->prepareStatusCodes());
            });
        });
    }

    private function prepareStatusCodes(): array
    {
        if ($this->provider && $this->statusCode) {
            $statusEnum = DataProviderType::getProviderTransactionStatusClass($this->provider);
            $statusCode = $statusEnum::fromKey($this->statusCode);

            return [$statusCode];
        } else {
            return $this->getAllMatchedStatus($this->statusCode);
        }
    }

    private function getAllMatchedStatus($statusCode): array
    {
        return collect([
            TransactionXStatus::class,
            TransactionYStatus::class,
        ])
            ->map(function ($statusEnum) use ($statusCode) {
                return $statusEnum::fromKey($statusCode)->value;
            })
            ->toArray();
    }
}
