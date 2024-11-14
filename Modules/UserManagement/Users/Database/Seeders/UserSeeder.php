<?php

namespace Modules\UserManagement\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UserManagement\Users\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Erfan',
            'last_name' => 'rasooli',
            'email' => 'rasooli@gmail.com',
            'phone_number' => '09036583793',
            'is_superadmin' => 1,
        ]);
    }
}
