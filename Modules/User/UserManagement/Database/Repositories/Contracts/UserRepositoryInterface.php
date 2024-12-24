<?php

namespace Modules\User\UserManagement\Database\Repositories\Contracts;

use Modules\Base\Repositories\Contracts\BaseWithAllQueriesRepositoryInterface;

interface UserRepositoryInterface extends BaseWithAllQueriesRepositoryInterface
{
    public function checkUserExists(string $number) : bool;
}
