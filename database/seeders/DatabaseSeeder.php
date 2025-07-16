<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user
        Users::create([
            'name' => 'Administrator',
            'email' => 'admin@lestariwisatadieng.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}
