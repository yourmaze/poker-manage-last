<?php

namespace App\Policies;

use App\Model\Tournament;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TournamentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\User $user
     * @param Tournament $tournament
     * @return mixed
     */
    public function view(User $user, Tournament $tournament)
    {
        if ($user->company_id != $tournament->company_id) {
            abort(404);
        }
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  Tournament  $tournament
     * @return mixed
     */
    public function update(User $user, Tournament $tournament)
    {
        if ($user->company_id != $tournament->company_id) {
            return $this->deny('У вас не достаточно прав на совершение этого действия. Обратитесь к администратору.');
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Tournament  $tournament
     * @return mixed
     */
    public function delete(User $user, Tournament $tournament)
    {
        if ($user->company_id != $tournament->company_id) {
            return $this->deny('У вас не достаточно прав на совершение этого действия. Обратитесь к администратору.');
        }
        return true;
    }
}
