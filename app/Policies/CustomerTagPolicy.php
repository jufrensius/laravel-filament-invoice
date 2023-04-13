<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\CustomerTag;
use App\Models\User;

class CustomerTagPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any CustomerTag');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CustomerTag $customertag): bool
    {
        return $user->can('view CustomerTag');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create CustomerTag');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CustomerTag $customertag): bool
    {
        return $user->can('update CustomerTag');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CustomerTag $customertag): bool
    {
        return $user->can('delete CustomerTag');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CustomerTag $customertag): bool
    {
        return $user->can('restore CustomerTag');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CustomerTag $customertag): bool
    {
        return $user->can('force-delete CustomerTag');
    }
}
