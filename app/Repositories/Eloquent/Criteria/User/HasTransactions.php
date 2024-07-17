<?php

namespace App\Repositories\Eloquent\Criteria\User;

use App\Repositories\Criteria\CriterionInterface;

class HasTransactions implements CriterionInterface
{
    public function apply($model)
    {
        return $model->has('transactions');
    }
}
