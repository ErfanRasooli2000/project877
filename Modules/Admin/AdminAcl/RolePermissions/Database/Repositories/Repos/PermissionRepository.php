<?php

namespace Modules\Admin\AdminAcl\RolePermissions\Database\Repositories\Repos;

use Illuminate\Database\Eloquent\Collection;
use Modules\Admin\AdminAcl\RolePermissions\Database\Repositories\Contracts\PermissionRepositoryInterface;
use Modules\Base\Repositories\Repos\BaseRepository;
use Spatie\Permission\Models\Permission;

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
