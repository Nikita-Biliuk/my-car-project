<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;

class CarPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Car $car)
    {
        if ($user->type === "admin") {
            return true;
        }

        if ($user->type === "user" && $car->owner_id === $user->id) {
            return true;
        }

        if ($user->type === "reader") {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Car $car)
    {
        if ($user->type === "admin") {
            return true;
        }

        if ($user->type === "user" && $car->owner_id === $user->id) {
            return true;
        }


        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Car $car)
    {
        if ($user->type === "admin") {
            return true;
        }

        if ($user->type === "user" && $car->owner_id === $user->id) {
            return true;
        }

        return false;
    }
}



