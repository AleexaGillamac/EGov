<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // Complaints
            ['name' => 'create_complaint',  'guard_name' => 'web', 'label' => 'Create Complaint', 'description' => 'Allows citizens or staff to create a new complaint'],
            ['name' => 'update_complaint',  'guard_name' => 'web', 'label' => 'Update Complaint', 'description' => 'Allows updating an existing complaint'],
            ['name' => 'delete_complaint',  'guard_name' => 'web', 'label' => 'Delete Complaint', 'description' => 'Allows deleting a complaint'],
            ['name' => 'view_complaint',  'guard_name' => 'web', 'label' => 'View Complaint', 'description' => 'Allows viewing all complaints'],
            ['name' => 'view_office_complaints',  'guard_name' => 'web', 'label' => 'View Office Complaints', 'description' => 'Allows viewing complaints assigned to the user’s office only'],
            ['name' => 'resolve_complaint',  'guard_name' => 'web', 'label' => 'Resolve Complaint', 'description' => 'Allows marking a complaint as resolved'],
            ['name' => 'close_complaint',  'guard_name' => 'web', 'label' => 'Close Complaint', 'description' => 'Allows closing a resolved complaint after verification'],

            // Feedback
            ['name' => 'create_feedback', 'guard_name' => 'web', 'label' => 'Create Feedback', 'description' => 'Allows creating feedback'],
            ['name' => 'update_feedback', 'guard_name' => 'web', 'label' => 'Update Feedback', 'description' => 'Allows updating feedback'],
            ['name' => 'view_feedback', 'guard_name' => 'web', 'label' => 'View Feedback', 'description' => 'Allows viewing feedback'],

            // Office Management
            ['name' => 'create_office', 'guard_name' => 'web', 'label' => 'Create Office', 'description' => 'Allows creating a new office'],
            ['name' => 'update_office', 'guard_name' => 'web', 'label' => 'Update Office', 'description' => 'Allows updating office information'],
            ['name' => 'delete_office', 'guard_name' => 'web', 'label' => 'Delete Office', 'description' => 'Allows deleting an office'],
            ['name' => 'view_office', 'guard_name' => 'web', 'label' => 'View Office', 'description' => 'Allows viewing office details'],

            // Employee Management
            ['name' => 'create_employee', 'guard_name' => 'web', 'label' => 'Create Employee', 'description' => 'Allows creating a new employee record'],
            ['name' => 'update_employee', 'guard_name' => 'web', 'label' => 'Update Employee', 'description' => 'Allows updating employee details'],
            ['name' => 'delete_employee', 'guard_name' => 'web', 'label' => 'Delete Employee', 'description' => 'Allows deleting an employee record'],
            ['name' => 'view_employee', 'guard_name' => 'web', 'label' => 'View Employee', 'description' => 'Allows viewing employee information'],

            // Director Management
            ['name' => 'create_director', 'guard_name' => 'web', 'label' => 'Create Director', 'description' => 'Allows creating a new director record'],
            ['name' => 'update_director', 'guard_name' => 'web', 'label' => 'Update Director', 'description' => 'Allows updating director information'],
            ['name' => 'delete_director', 'guard_name' => 'web', 'label' => 'Delete Director', 'description' => 'Allows deleting a director record'],
            ['name' => 'view_director', 'guard_name' => 'web', 'label' => 'View Director', 'description' => 'Allows viewing director details'],
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm['name'], 'guard_name' => 'web'], [
                'label' => $perm['label'],
                'description' => $perm['description'],
            ]);
        }

        // Create Roles and Assign Permissions
        $roles = [
            'superAdmin' => [
                'permissions' => Permission::all()->pluck('name')->toArray(),
                'label' => 'Super Administrator',
                'description' => 'Full system access with all permissions',
            ],
            'admin' => [
                'permissions' => [
                    'create_complaint', 'update_complaint', 'delete_complaint',
                    'view_complaint', 'close_complaint',
                    'create_office', 'update_office', 'view_office',
                    'create_employee', 'update_employee', 'view_employee',
                    'create_director', 'update_director', 'view_director',
                    'create_feedback', 'update_feedback', 'view_feedback',
                ],
                'label' => 'Administrator',
                'description' => 'Administrative access with management capabilities',
            ],
            'director' => [
                'permissions' => [
                    'view_complaint',
                    'view_feedback',
                    'close_complaint',
                    'create_employee',
                    'view_employee',
                ],
                'label' => 'Director',
                'description' => 'Department director with oversight capabilities',
            ],
            'employee' => [
                'permissions' => [
                    'view_office_complaints',
                    'create_feedback',
                    'view_complaint',
                    'resolve_complaint',
                    'view_feedback',
                ],
                'label' => 'Employee',
                'description' => 'Standard employee access for handling complaints',
            ],
            'citizen' => [
                'permissions' => ['create_complaint', 'update_complaint', 'view_complaint'],
                'label' => 'Citizen',
                'description' => 'Basic user access for submitting complaints',
            ],
        ];

        foreach ($roles as $roleName => $roleData) {
            $role = Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => 'web'],
                [
                    'label' => $roleData['label'],
                    'description' => $roleData['description'],
                ]
            );
            $role->syncPermissions($roleData['permissions']);
        }
    }
}
