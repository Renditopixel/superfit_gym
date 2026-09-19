<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator Gym',
            'email' => 'admin@superfit.com',
            'password' => Hash::make('admin123'),
            'phone' => '081234567890',
            'gender' => 'L',
            'height' => 170,
            'weight' => 65,
            'role' => 'admin',
        ]);
    }
}