<?php

namespace App\Policies;

use App\Models\Office;
use App\Models\User;

class OfficePolicy
{
    /**
     * Allow everyone (even guests) to view all offices.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Allow everyone (even guests) to view a specific office.
     */
    public function view(?User $user, Office $office): bool
    {
        return true;
    }

    /**
     * Only admins can create new offices.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'superadmin']);
    }

    /**
     * Only admins and supervisors can update office details.
     */
    public function update(User $user, Office $office): bool
    {
        return $user->hasRole(['admin', 'superadmin']);
    }

    /**
     * Only super admins can delete offices.
     */
    public function delete(User $user, Office $office): bool
    {
        return $user->hasRole(['admin', 'superadmin']);
    }

    /**
     * Only super admins can restore soft-deleted offices.
     */
    public function restore(User $user, Office $office): bool
    {
        return $user->hasRole(['superadmin']);
    }
}
