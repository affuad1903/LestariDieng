<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing admin if exists
        Users::where('email', 'admin@lestariwisatadieng.com')->delete();
        
        // Create admin user
        Users::create([
            'name' => 'Admin LWD',
            'email' => 'admin@lestariwisatadieng.com',
            'password' => Hash::make('AdminLestariDieng12345'),
            'role' => 'admin'
        ]);
        
        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@lestariwisatadieng.com');
        $this->command->info('Password: AdminLestariDieng12345');
    }
}
