<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\City\Database\Seeders\CitySeeder;
use Modules\City\Database\Seeders\ProvinceSeeder;
use Modules\UserManagement\Users\Database\Seeders\AdminSeeder;
use Modules\UserManagement\Users\Models\Admin;

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
            ProvinceSeeder::class,
            CitySeeder::class,
        ]);
    }
}
