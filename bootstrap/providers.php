<?php

use Modules\Acl\RolePermissions\Providers\RolePermissionServiceProvider;
use Modules\City\Providers\ProvinceServiceProvider;
use Modules\UserManagement\Users\Providers\UserServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    \Modules\Acl\Auth\Providers\AuthServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    UserServiceProvider::class,
    RolePermissionServiceProvider::class,
    ProvinceServiceProvider::class,
];
