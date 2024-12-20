<?php

namespace Modules\User\UserAcl\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Route::prefix('api/v1/users/authentication')
            ->middleware(['api'])
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
