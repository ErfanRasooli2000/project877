<?php

namespace Modules\Admin\AdminAcl\RolePermissions\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\AdminAcl\RolePermissions\Commands\syncPermissions;

class RolePermissionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(RolePermissionRepositoryServiceProvider::class);
    }

    public function boot()
    {
        Route::prefix('/api/v1/admin/role-permissions')
            ->middleware(['api' , 'auth:sanctum'])
            ->group(__DIR__ . '/../Routes/api.php');

        if ($this->app->runningInConsole()) {
            $this->commands(syncPermissions::class);
        }
    }
}
