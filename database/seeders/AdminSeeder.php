<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@blogyaari.com'],
            [
                'name'     => 'Admin',
                'email'    => 'admin@blogyaari.com',
                'password' => Hash::make('admin@123'),
            ]
        );
    }
}
