<?php

namespace Modules\Acl\RolePermissions\Database\Repositories\Repos;

use Illuminate\Database\Eloquent\Collection;
use Modules\Acl\RolePermissions\Database\Repositories\Contracts\PermissionRepositoryInterface;
use Modules\Acl\RolePermissions\Database\Repositories\Contracts\RoleRepositoryInterface;
use Modules\Base\Repositories\Repos\BaseRepository;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct(
        protected Permission $model
    ){}

    public function all(): Collection
    {
        return $this->model->all();
    }
}
