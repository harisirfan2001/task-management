<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create roles if they don't exist
        $roles = ['super-admin', 'project-manager', 'developer', 'qa'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create Super Admin user
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@superadmin.com'], // Unique identifier
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'), // Set a default password
            ]
        );

        // Assign the super-admin role
        $superAdmin->assignRole('super-admin');

        $this->command->info('Super Admin user created or updated successfully!');
    }
}


