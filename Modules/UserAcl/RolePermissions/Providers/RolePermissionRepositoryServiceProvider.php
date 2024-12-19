<?php

namespace Modules\Acl\RolePermissions\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Acl\RolePermissions\Database\Repositories\Contracts\PermissionRepositoryInterface;
use Modules\Acl\RolePermissions\Database\Repositories\Contracts\RoleRepositoryInterface;
use Modules\Acl\RolePermissions\Database\Repositories\Repos\PermissionRepository;
use Modules\Acl\RolePermissions\Database\Repositories\Repos\RoleRepository;

class RolePermissionRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class , PermissionRepository::class);
    }
}
