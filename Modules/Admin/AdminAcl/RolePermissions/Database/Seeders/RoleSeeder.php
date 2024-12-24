<?php

namespace Modules\Admin\AdminAcl\RolePermissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'user' , 'guard_name' => 'client-api']);
        Role::create(['name' => 'salonOwner' , 'guard_name' => 'client-api']);
    }
}
