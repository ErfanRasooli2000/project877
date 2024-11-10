<?php

use Modules\Acl\RolePermissions\Providers\RolePermissionServiceProvider;
use Modules\UserManagement\Users\Providers\UserServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    UserServiceProvider::class,
    RolePermissionServiceProvider::class,
];
