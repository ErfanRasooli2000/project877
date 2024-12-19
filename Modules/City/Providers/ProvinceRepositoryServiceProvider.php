<?php

namespace Modules\City\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\City\Database\Repositories\Contracts\ProvinceRepositoryInterface;
use Modules\City\Database\Repositories\Repos\ProvinceRepository;

class ProvinceRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ProvinceRepositoryInterface::class,ProvinceRepository::class);
    }
}
