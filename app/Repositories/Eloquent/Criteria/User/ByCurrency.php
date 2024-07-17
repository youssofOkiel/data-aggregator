<?php

namespace App\Repositories\Eloquent\Criteria\User;

use App\Repositories\Criteria\CriterionInterface;

class ByCurrency implements CriterionInterface
{
    public function __construct(protected ?string $currency) {}

    public function apply($model)
    {
        return $model->when($this->currency, function ($query) {
            return $query->whereHas('transactions', function ($query) {
                $query->where('currency', $this->currency);
            });
        });
    }
}
