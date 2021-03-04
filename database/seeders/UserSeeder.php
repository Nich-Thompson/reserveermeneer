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
        // TODO: php artisan db:seed does not seed, instead have to specify: php artisan db:seed --class=UserSeeder
        $admin = User::create([
            'name' => "admin",
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
