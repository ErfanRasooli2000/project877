<?php

namespace Modules\Admin\AdminManagement\Admins\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\AdminManagement\Admins\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'first_name' => 'Erfan',
            'last_name' => 'rasooli',
            'email' => 'rasooli@gmail.com',
            'phone_number' => '09036583793',
            'is_superadmin' => 1,
        ]);
    }
}
