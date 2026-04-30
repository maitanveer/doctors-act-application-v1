<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create superadmin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@ibnsinafoundation.org',
            'password' => Hash::make('password123'), // Change this password!
            'role' => 'superadmin',
            'is_active' => true,
        ]);

        echo "✅ SuperAdmin created successfully!\n";
        echo "Email: admin@ibnsinafoundation.org\n";
        echo "Password: password123\n";
        echo "⚠️  Please change this password after first login!\n";
    }
}

