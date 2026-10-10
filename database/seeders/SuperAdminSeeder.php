<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pelvicare.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@pelvicare.com',
                'password' => Hash::make('admin123'),
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Super Admin created successfully!');
        $this->command->info('Email: admin@pelvicare.com');
        $this->command->info('Password: admin123');
    }
}

