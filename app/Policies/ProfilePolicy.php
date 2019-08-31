<?php

namespace App\Policies;

use App\Models\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Provide checks when creating new profiles
     *
     * @param User $user
     *
     * @return bool
     */
    public function create( User $user )
    {
        if ($user->id == 1) {
            return true;
        }
    }
}
