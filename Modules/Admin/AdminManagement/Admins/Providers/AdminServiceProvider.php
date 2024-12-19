<?php

namespace Modules\Admin\AdminManagement\Admins\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(AdminRepositoryServiceProvider::class);
    }

    public function boot()
    {
        Route::prefix('api/v1/admins')
            ->middleware(['api' , 'auth:sanctum'])
            ->group(__DIR__ . '/../Routes/api.php');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
