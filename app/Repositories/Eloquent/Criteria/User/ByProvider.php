<?php

namespace App\Repositories\Eloquent\Criteria\User;

use App\Repositories\Criteria\CriterionInterface;

class ByProvider implements CriterionInterface
{
    public function __construct(protected ?string $provider) {}

    public function apply($model)
    {
        return $model->when($this->provider, function ($query, $provider) {
            return $query->whereHas('transactions', function ($query) use ($provider) {

                $query->where('provider', $provider);
            });
        });
    }
}
