<?php

namespace App\Policies;

use App\Models\User;

class FeedbackPolicy
{
    /**
     * Determine whether the user can view any feedbacks.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['Citizen', 'Employee', 'Director', 'Admin', 'Superadmin']);
    }

    /**
     * Determine whether the user can view the feedback.
     */
    public function view(User $user, Feedback $feedback): bool
    {
        // Citizen can only view feedbacks for their own complaint
        if ($user->hasRole('Citizen')) {
            return optional($feedback->complaint)->user_id === $user->id;
        }

        // Employee or Office Head can view feedbacks belonging to their office
        if ($user->hasAnyRole(['Employee', 'Director'])) {
            return $feedback->office_id === $user->office_id;
        }

        // Admins and Superadmins can view all
        return $user->hasAnyRole(['Admin', 'Superadmin']);
    }

    /**
     * Determine whether the user can create feedback for a complaint.
     */
    public function create(User $user, Complaint $complaint): bool
    {
        // Only employees and office director can respond to complaints assigned to their office
        if ($user->hasAnyRole(['Employee', 'Director'])) {
            return $complaint->office_id === $user->office_id;
        }

        // Admin and Superadmin can respond to any complaint
        return $user->hasAnyRole(['Admin', 'Superadmin']);
    }

    /**
     * Determine whether the user can delete the feedback.
     */
    public function delete(User $user, Feedback $feedback): bool
    {
        // Only admins or superadmins can delete feedback
        return $user->hasAnyRole(['Admin', 'Superadmin']);
    }
}
