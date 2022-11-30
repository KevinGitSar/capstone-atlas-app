<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

// $table->string('first_name');
// $table->string('last_name');
// $table->date('birthdate');
// $table->string('email')->unique();
// $table->string('username')->unique();
// $table->string('password');
// $table->string('role');
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => 'Admin',
            'last_name' => 'One',
            'birthdate' => Carbon::parse(Carbon::now())->format('Y-m-d'),
            'username' => 'AdminOne',
            'password' => bcrypt('adminone'),
            'role' => 'admin'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
