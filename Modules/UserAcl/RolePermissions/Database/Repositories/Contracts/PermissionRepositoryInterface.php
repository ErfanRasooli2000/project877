<?php

namespace Modules\Acl\RolePermissions\Database\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Modules\Base\Repositories\Contracts\BaseRepositoryInterface;

interface PermissionRepositoryInterface extends BaseRepositoryInterface
{
    public function all() :Collection;
}
