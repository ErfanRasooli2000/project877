<?php

namespace Modules\City\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\City\Database\Repositories\Contracts\CityRepositoryInterface;
use Modules\City\Database\Repositories\Repos\CityRepository;

class CityRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CityRepositoryInterface::class,CityRepository::class);
    }
}
