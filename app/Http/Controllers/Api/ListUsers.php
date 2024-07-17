<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListUsersRequest;
use App\Http\Resources\Api\UserResource;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\Criteria\EagerLoading;
use App\Repositories\Eloquent\Criteria\User\ByAmount;
use App\Repositories\Eloquent\Criteria\User\ByCurrency;
use App\Repositories\Eloquent\Criteria\User\ByProvider;
use App\Repositories\Eloquent\Criteria\User\ByStatusCode;
use App\Repositories\Eloquent\Criteria\User\HasTransactions;
use Illuminate\Http\Request;

class ListUsers extends Controller
{
    public function __construct(protected UserRepository $userRepository) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(ListUsersRequest $request)
    {
        $users = $this->userRepository->withCriteria(
            new EagerLoading(['transactions']),
            new HasTransactions(),
            new ByProvider($request->validated('provider')),
            new ByStatusCode($request->validated('statusCode'), $request->validated('provider')),
            new ByCurrency($request->validated('currency')),
            new ByAmount($request->validated('balanceMin'), $request->validated('balanceMmax'))
        )
            ->all();

        return UserResource::collection($users);
    }
}
