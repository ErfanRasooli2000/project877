<?php

namespace Modules\Admin\AdminManagement\Admins\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\AdminManagement\Admins\Models\Admin;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\UserManagement\Users\Models\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
