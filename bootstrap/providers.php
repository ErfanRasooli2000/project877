<?php

use Modules\Admin\AdminAcl\Auth\Providers\AuthServiceProvider;
use Modules\Admin\AdminAcl\RolePermissions\Providers\RolePermissionServiceProvider;
use Modules\Admin\AdminManagement\Admins\Providers\AdminServiceProvider;
use Modules\City\Providers\ProvinceServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    AuthServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    AdminServiceProvider::class,
    RolePermissionServiceProvider::class,
    ProvinceServiceProvider::class,
];
