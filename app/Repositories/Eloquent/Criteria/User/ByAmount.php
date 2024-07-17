<?php

namespace App\Repositories\Eloquent\Criteria\User;

use App\Repositories\Criteria\CriterionInterface;

class ByAmount implements CriterionInterface
{
    public function __construct(protected ?float $min, protected ?float $max) {}

    public function apply($model)
    {
        return $model->when($this->min, function ($query) {
            return $query->whereHas('transactions', function ($query) {
                $query->where('amount', '>=', $this->min);
            });
        })->when($this->max, function ($query) {
            return $query->whereHas('transactions', function ($query) {
                $query->where('amount', '<=', $this->max);
            });
        });
    }
}
