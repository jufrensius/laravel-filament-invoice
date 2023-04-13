<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\PaymentMethod;
use App\Models\User;

class PaymentMethodPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view-any PaymentMethod');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PaymentMethod $paymentmethod): bool
    {
        return $user->can('view PaymentMethod');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create PaymentMethod');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PaymentMethod $paymentmethod): bool
    {
        return $user->can('update PaymentMethod');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PaymentMethod $paymentmethod): bool
    {
        return $user->can('delete PaymentMethod');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PaymentMethod $paymentmethod): bool
    {
        return $user->can('restore PaymentMethod');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PaymentMethod $paymentmethod): bool
    {
        return $user->can('force-delete PaymentMethod');
    }
}
