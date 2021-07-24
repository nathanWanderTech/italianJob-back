<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Auth\Access\HandlesAuthorization;

class VehiclePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Vehicle $vehicle
     * @return mixed
     */
    public function view(User $user, Vehicle $vehicle)
    {
        return $user->id === $vehicle->owner_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Vehicle $vehicle
     * @return mixed
     */
    public function update(User $user, Vehicle $vehicle)
    {
        return $user->id === $vehicle->owner_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Vehicle $vehicle
     * @return mixed
     */
    public function delete(User $user, Vehicle $vehicle)
    {
        return $user->id === $vehicle->owner_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Vehicle $vehicle
     * @return mixed
     */
    public function restore(User $user, Vehicle $vehicle)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Vehicle $vehicle
     * @return mixed
     */
    public function forceDelete(User $user, Vehicle $vehicle)
    {
        //
    }
}
