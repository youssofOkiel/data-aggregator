<?php

namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Criteria\CriterionInterface;

class EagerLoading implements CriterionInterface
{
    public function __construct(protected array $relations) {}

    public function apply($model)
    {
        return $model->with($this->relations);
    }
}
