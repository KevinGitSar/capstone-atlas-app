<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'One',
            'email' => 'AdminOne@administrator.com',
            'birthdate' => Carbon::parse(Carbon::now())->format('Y-m-d'),
            'username' => 'AdminOne',
            'password' => bcrypt('adminone'),
            'role' => 'admin'
        ]);

        User::create([
            'first_name' => 'Kevin',
            'last_name' => 'Sar',
            'email' => 'Kev1@email.com',
            'birthdate' => Carbon::parse(Carbon::now())->format('Y-m-d'),
            'username' => 'Kev1',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);

        User::create([
            'first_name' => 'Kevin',
            'last_name' => 'Sar',
            'email' => 'Kev2@email.com',
            'birthdate' => Carbon::parse(Carbon::now())->format('Y-m-d'),
            'username' => 'Kev2',
            'password' => bcrypt('password'),
            'role' => 'user'
        ]);
    }
}
