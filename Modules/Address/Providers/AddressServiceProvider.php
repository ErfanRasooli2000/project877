<?php

namespace Modules\Address\Providers;

use Illuminate\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(AddressRepositoryServiceProvider::class);
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }
}
