<?php

namespace Modules\Acl\RolePermissions\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Acl\RolePermissions\Commands\syncPermissions;

class RolePermissionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RolePermissionServiceProvider::class);
    }

    public function boot()
    {
        Route::prefix('/api/v1/role-permissions')
            ->middleware(['api' , 'auth:sanctum'])
            ->group(__DIR__ . '/../Routes/api.php');

        if ($this->app->runningInConsole()) {
            $this->commands(syncPermissions::class);
        }
    }
}
