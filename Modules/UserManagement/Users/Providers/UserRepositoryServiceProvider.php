<?php

namespace Modules\UserManagement\Users\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\UserManagement\Users\Database\Repositories\Contracts\UserRepositoryInterface;
use Modules\UserManagement\Users\Database\Repositories\Repos\UserRepository;

class UserRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    public function boot()
    {

    }
}
