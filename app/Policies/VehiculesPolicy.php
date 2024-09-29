<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicule;
//use Illuminate\Auth\Access\Response;

class VehiculesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function create(User $user): bool
{
    // Autorise uniquement les utilisateurs ayant le rôle de conducteur
    return $user->role === 'conducteur';
}

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vehicule $vehicules): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vehicule $vehicules): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vehicule $vehicules): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vehicule $vehicules): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vehicule $vehicules): bool
    {
        //
    }
}
