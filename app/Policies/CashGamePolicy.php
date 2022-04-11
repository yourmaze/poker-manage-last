<?php

namespace App\Policies;

use App\Model\CashGame;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CashGamePolicy
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
     * @param  \App\User  $user
     * @param  \App\Model\CashGame  $cashGame
     * @return mixed
     */
    public function view(User $user, CashGame $cashGame)
    {
        if ($user->company_id != $cashGame->company_id) {
            return $this->deny('У вас не достаточно прав на совершение этого действия. Обратитесь к администратору.');
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
     * @param  \App\Model\CashGame  $cashGame
     * @return mixed
     */
    public function update(User $user, CashGame $cashGame)
    {
        if ($user->company_id != $cashGame->company_id) {
            return $this->deny('У вас не достаточно прав на совершение этого действия. Обратитесь к администратору.');
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\CashGame  $cashGame
     * @return mixed
     */
    public function delete(User $user, CashGame $cashGame)
    {
        if ($user->company_id != $cashGame->company_id) {
            return $this->deny('У вас не достаточно прав на совершение этого действия. Обратитесь к администратору.');
        }
        return true;
    }
}
