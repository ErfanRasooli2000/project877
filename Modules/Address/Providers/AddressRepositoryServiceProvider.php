<?php

namespace Modules\Address\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Address\Database\Repositories\Contracts\AddressRepositoryInterface;
use Modules\Address\Database\Repositories\Repos\AddressRepository;

class AddressRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AddressRepositoryInterface::class,AddressRepository::class);
    }
}
