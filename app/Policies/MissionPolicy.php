<?php

namespace App\Policies;

use App\User;
use App\Mission;
use Illuminate\Auth\Access\HandlesAuthorization;

class MissionPolicy
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
     * 閲覧権限
     * @param User $user
     * @param Mission $mission
     * @return bool
     */
    public function view(User $user, Mission $mission)
    {
        return $user->id === $mission->user_id;
    }
}
