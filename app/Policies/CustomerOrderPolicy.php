<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\CustomerOrder;
use App\Models\User;

class CustomerOrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any CustomerOrder');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CustomerOrder $customerorder): bool
    {
        return $user->can('view CustomerOrder');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create CustomerOrder');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CustomerOrder $customerorder): bool
    {
        return $user->can('update CustomerOrder');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CustomerOrder $customerorder): bool
    {
        return $user->can('delete CustomerOrder');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CustomerOrder $customerorder): bool
    {
        return $user->can('restore CustomerOrder');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CustomerOrder $customerorder): bool
    {
        return $user->can('force-delete CustomerOrder');
    }
}
