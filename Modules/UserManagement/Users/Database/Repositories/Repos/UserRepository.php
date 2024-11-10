<?php

namespace Modules\UserManagement\Users\Database\Repositories\Repos;

use Modules\Base\Repositories\Repos\BaseWithAllQueriesRepository;
use Modules\UserManagement\Users\Database\Repositories\Contracts\UserRepositoryInterface;
use Modules\UserManagement\Users\Models\User;

class UserRepository extends BaseWithAllQueriesRepository implements UserRepositoryInterface
{
    public function __construct(
        protected User $model
    ){}
}
