<?php

namespace Modules\Admin\AdminManagement\Admins\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Admin\AdminManagement\Admins\Database\Repositories\Contracts\AdminRepositoryInterface;
use Modules\Admin\AdminManagement\Admins\Database\Repositories\Repos\AdminRepository;

class AdminRepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
    }

    public function boot()
    {

    }
}
