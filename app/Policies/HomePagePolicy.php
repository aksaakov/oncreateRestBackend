<?php

namespace App\Policies;

use App\User;
use App\HomePage;
use App\Settings;
use Illuminate\Auth\Access\HandlesAuthorization;

class HomePagePolicy
{
    use HandlesAuthorization;

    protected function tgAccess(User $user, HomePage $homepage)
    {
        return $user->access_full || ($user->access_homepage && $allow_cities);
    }

    /**
     * Determine whether the user can view the taxGroup.
     *
     * @param  \App\User  $user
     * @param  \App\HomePage  $homepage
     * @return mixed
     */
    public function view(User $user, HomePage $homepage)
    {
        return $this->tgAccess($user, $homepage);
    }

    /**
     * Determine whether the user can create taxGroups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->tgAccess($user, new HomePage());
    }

    /**
     * Determine whether the user can update the taxGroup.
     *
     * @param  \App\User  $user
     * @param  \App\HomePage  $homepage
     * @return mixed
     */
    public function update(User $user, HomePage $homepage)
    {
        return $this->tgAccess($user, $homepage);
    }

    /**
     * Determine whether the user can delete the taxGroup.
     *
     * @param  \App\User  $user
     * @param  \App\HomePage  $homepage
     * @return mixed
     */
    public function delete(User $user, HomePage $homepage)
    {
        return $this->tgAccess($user, $homepage);
    }
}
