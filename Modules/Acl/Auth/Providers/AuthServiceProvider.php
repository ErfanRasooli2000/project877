<?php

namespace Modules\Acl\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Route::prefix('api/v1/authentication')
            ->middleware(['api'])
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
