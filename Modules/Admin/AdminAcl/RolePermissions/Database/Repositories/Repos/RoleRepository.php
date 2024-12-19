<?php

namespace Modules\Admin\AdminAcl\RolePermissions\Database\Repositories\Repos;

use Illuminate\Database\Eloquent\Collection;
use Modules\Acl\RolePermissions\Database\Repositories\Contracts\RoleRepositoryInterface;
use Modules\Base\Repositories\Repos\BaseRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(
        protected Role $model
    ){}

    public function all(): Collection
    {
        return $this->model->all();
    }
}
