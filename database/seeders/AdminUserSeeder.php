<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@medprofessional.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@medprofessional.com',
                'phone' => '08000000000',
                'role' => 'admin',
                'password' => Hash::make('admin@medprofessional.com'), // You should change this later
                'email_verified_at' => now(),
            ]
        );
    }
}
