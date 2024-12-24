<?php

namespace Modules\User\UserManagement\Database\Repositories\Repos;

use Modules\Base\Repositories\Repos\BaseWithAllQueriesRepository;
use Modules\User\UserManagement\Database\Repositories\Contracts\UserRepositoryInterface;
use Modules\User\UserManagement\Models\User;

class UserRepository extends BaseWithAllQueriesRepository implements UserRepositoryInterface
{
    public function __construct(
        protected User $model
    ){}

    public function checkUserExists(string $number): bool
    {
        return $this->model
            ->newQuery()
            ->where('phone_number', $number)
            ->withTrashed()
            ->exists();
    }
}