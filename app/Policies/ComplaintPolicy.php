<?php

namespace App\Policies;

use App\Models\User;

class ComplaintPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        
    }

   public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Citizen', 'Employee', 'Office Head', 'Admin', 'Superadmin']);
    }

    /**
     * Determine whether the user can view the complaint.
     */
    public function view(User $user, Complaint $complaint): bool
    {
        // Citizens can only view their own complaints (unless anonymous)
        if ($user->hasRole('Citizen')) {
            return $complaint->user_id === $user->id;
        }

        // Employees/Office Heads can view complaints assigned to their office
        if ($user->hasAnyRole(['Employee', 'Office Head'])) {
            return $complaint->office_id === $user->office_id;
        }

        // Admins and Superadmins can view everything
        return $user->hasAnyRole(['Admin', 'Superadmin']);
    }

    /**
     * Determine whether the user can create complaints.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('Citizen');
    }

    /**
     * Determine whether the user can update the complaint.
     */
    public function update(User $user, Complaint $complaint): bool
    {
        // Office staff can update status of complaints in their office
        if ($user->hasAnyRole(['Employee', 'Office Head'])) {
            return $complaint->office_id === $user->office_id;
        }

        // Admin and Superadmin can update all
        return $user->hasAnyRole(['Admin', 'Superadmin']);
    }

    /**
     * Determine whether the user can delete the complaint.
     */
    public function delete(User $user, Complaint $complaint): bool
    {
        // Only admins and superadmins can delete
        return $user->hasAnyRole(['Admin', 'Superadmin']);
    }
}
