<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin
        User::create([
            'name' => "admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => '1',
        ]);

        // Create customer
        User::create([
            'name' => "customer",
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => '0',
        ]);
    }
}
