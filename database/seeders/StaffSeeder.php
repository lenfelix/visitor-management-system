<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '89267856',
            'staff_id' => 'S2684',
            'is_verified' => '0',
            'password' => Hash::make('password'),
        ]);
    }
}
