<?php

namespace Modules\Admin\AdminAcl\Auth\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Route::prefix('api/v1/admin/authentication')
            ->middleware(['api'])
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
