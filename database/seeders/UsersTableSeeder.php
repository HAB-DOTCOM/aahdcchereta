<?php

namespace Database\Seeders;
use App\Models\User; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create the admin user
        $adminUser = User::create([
            'id' => Str::uuid(),
            'first_name' => 'hab',
            'middle_name' => 'Doe',
            'last_name' => 'Smith',
            'email' => 'hab@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Consider using more secure passwords in production
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assuming roles have been created in a previous migration or seeder
        // and the Spatie Permission package is properly configured.
        // First, check if the 'admin' role exists.
        $adminRole = Role::where('name', 'admin')->first();
        
        if ($adminRole) {
            // Assign "admin" role to the admin user
            $adminUser->assignRole($adminRole);
        } else {
            // Optional: create the admin role if it doesn't exist
            $adminRole = Role::create(['name' => 'admin']);
            $adminUser->assignRole($adminRole);
        }
    }
}