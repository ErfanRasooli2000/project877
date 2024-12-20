<?php

namespace Modules\User\UserManagement\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\UserManagement\Database\Repositories\Contracts\UserRepositoryInterface;
use Modules\User\UserManagement\Database\Repositories\Repos\UserRepository;

class UserRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
