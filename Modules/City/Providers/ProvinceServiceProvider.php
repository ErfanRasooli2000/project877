<?php

namespace Modules\City\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ProvinceServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(ProvinceRepositoryServiceProvider::class);
        $this->app->register(CityRepositoryServiceProvider::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        Route::prefix('api/v1/province-city')
            ->middleware('api')
            ->group(__DIR__ . '/../Routes/api.php');
    }
}
