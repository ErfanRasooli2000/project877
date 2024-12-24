<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\AdminAcl\RolePermissions\Database\Seeders\RoleSeeder;
use Modules\Admin\AdminManagement\Admins\Database\Seeders\AdminSeeder;
use Modules\City\Database\Seeders\CitySeeder;
use Modules\City\Database\Seeders\ProvinceSeeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
        ]);
    }
}
