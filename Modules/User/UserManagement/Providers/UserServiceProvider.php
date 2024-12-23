<?php

namespace Modules\User\UserManagement\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(UserRepositoryServiceProvider::class);
    }

    public function boot()
    {
        Route::prefix('api/v1/users')
            ->middleware(['api' , 'auth:sanctum'])
            ->group(__DIR__ . '/../Routes/api.php');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
