<?php

use Modules\Acl\RolePermissions\Providers\RolePermissionServiceProvider;
use Modules\Admin\AdminManagement\Admins\Providers\AdminServiceProvider;
use Modules\City\Providers\ProvinceServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    \Modules\Acl\Auth\Providers\AuthServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    AdminServiceProvider::class,
    RolePermissionServiceProvider::class,
    ProvinceServiceProvider::class,
];
