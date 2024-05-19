<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Owner;
use Illuminate\Auth\Access\HandlesAuthorization;

class OwnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any owners.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return True;
    }

    /**
     * Determine whether the user can view the owner.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Owner  $owner
     * @return mixed
     */
    public function view(User $user, Owner $owner)
    {
        if ($user->type === 'admin' || $user->type === 'reader') {
            return true;
        }
        return $user->id === $owner->user_id;
    }

    /**
     * Determine whether the user can create owners.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the owner.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Owner  $owner
     * @return mixed
     */
    public function update(User $user, Owner $owner)
    {

        if ($user->type === 'admin') {
            return true;
        }
        return $user->id === $owner->user_id;
    }

    /**
     * Determine whether the user can delete the owner.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Owner  $owner
     * @return mixed
     */
    public function delete(User $user, Owner $owner)
    {
        if ($user->type === 'admin') {
            return true;
        }
        return $user->id === $owner->user_id;
    }
}
