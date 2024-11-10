<?php

namespace Modules\UserManagement\Users\Services;

use Modules\Base\Services\BaseWithAllQueriesService;
use Modules\UserManagement\Users\Database\Repositories\Contracts\UserRepositoryInterface;

class UserService extends BaseWithAllQueriesService
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ){}

    protected function getFiltersForALlQuery(): array
    {
        // TODO: Implement getFiltersForALlQuery() method.
    }

    protected function getWithsForAllQuery(): array
    {
        // TODO: Implement getWithsForAllQuery() method.
    }
}
