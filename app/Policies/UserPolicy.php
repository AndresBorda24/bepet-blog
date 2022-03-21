<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    protected $super_admins = [
        'anjart24@gmail.com', 
        'amelia24@watson.en.com'
    ];

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return auth('sanctum')->user()->role_id === \App\Models\Role::IS_ADMIN;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model)
    {
        return auth('sanctum')->id() === $model->id || auth('sanctum')->user()->role_id === \App\Models\Role::IS_ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return $user->id == $model->id || $user->role_id === \App\Models\Role::IS_ADMIN;
    }

    /**
     * Determine whether the user can change another user's role
     */
    public function changeRole(User $user, User $model)
    {
        // dd($user);
        // dd($user->role_id === \App\Models\Role::IS_ADMIN &&
        // ! in_array($model->email, $this->super_admins) && 
        // in_array($user->email, $this->super_admins));

        return $user->role_id === \App\Models\Role::IS_ADMIN &&
                ! in_array($model->email, $this->super_admins) && 
                in_array($user->email, $this->super_admins);
    }
}
