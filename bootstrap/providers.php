<?php

use Modules\Admin\AdminAcl\RolePermissions\Providers\RolePermissionServiceProvider;
use Modules\Admin\AdminManagement\Admins\Providers\AdminServiceProvider;
use Modules\City\Providers\ProvinceServiceProvider;
use Modules\User\UserAcl\Auth\Providers\AuthServiceProvider as UserAuthServiceProvider;
use Modules\Admin\AdminAcl\Auth\Providers\AuthServiceProvider as AdminAuthServiceProvider;
use Modules\User\UserManagement\Providers\UserServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    UserAuthServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    AdminServiceProvider::class,
    RolePermissionServiceProvider::class,
    ProvinceServiceProvider::class,
    UserServiceProvider::class,
    AdminAuthServiceProvider::class,
];
