<?php

namespace Modules\Admin\AdminAcl\RolePermissions\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Admin\AdminAcl\RolePermissions\Database\Repositories\Contracts\PermissionRepositoryInterface;
use Modules\Admin\AdminAcl\RolePermissions\Database\Repositories\Contracts\RoleRepositoryInterface;
use Modules\Base\Services\BaseService;
use Spatie\Permission\Models\Role;

class RolePermissionService extends BaseService
{
    private $className;
    public function __construct(
        protected RoleRepositoryInterface $repository,
        protected PermissionRepositoryInterface $permissionRepository
    ){
        $this->className = __('classNames.role');
    }

    public function roles() :Collection
    {
        return $this->repository->all();
    }

    public function create(array $inputs) :array
    {
        $role = $this->repository->create($inputs);

        $role->permissions()->attach($inputs['permissions']);

        return [
            'status' => true,
            'message' => __('base.created' , ['attribute' => $this->className])
        ];
    }

    public function show(Role $role) :Role
    {
        return $role;
    }

    public function update(Role $role,array $inputs) :array
    {
        $role->update($inputs);

        $role->permissions()->sync($inputs['permissions']);

        return [
            'status' => true,
            'message' => __('base.updated' , ['attribute' => $this->className])
        ];
    }

    public function permissions() :Collection
    {
        return $this->permissionRepository->all();
    }
}
