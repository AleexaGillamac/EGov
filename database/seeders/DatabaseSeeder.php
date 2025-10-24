<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\OfficeSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run other seeders first
        $this->call([
            RolesAndPermissionsSeeder::class,
            OfficeSeeder::class,
        ]);

        // User::factory(10)->create();

       $superAdmin = User::factory()->create([
            'name' => 'Aleexa Gillamac',
            'email' => 'aleexagillamac747@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $superAdmin->assignRole('superadmin');

        // --- ADMIN ---
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@egov.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // --- DIRECTOR ---
        $director = User::factory()->create([
            'name' => 'Director User',
            'email' => 'director@egov.com',
            'password' => Hash::make('password'),
        ]);
        $director->assignRole('director');

        // --- EMPLOYEE ---
        $employee = User::factory()->create([
            'name' => 'Employee User',
            'email' => 'employee@egov.com',
            'password' => Hash::make('password'),
        ]);
        $employee->assignRole('employee');

        // --- REGULAR USER / CITIZEN ---
        $citizen = User::factory()->create([
            'name' => 'Juan Dela Cruz',
            'email' => 'juan@egov.com',
            'password' => Hash::make('password'),
        ]);
        $citizen->assignRole('user');
    }
}
