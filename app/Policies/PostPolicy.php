<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny()
    {
        // return $user->role_id === \App\Models\Role::IS_ADMIN;
        return auth()->user()->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user, Post $post)
    {
        return $post->status == 'PUBLICADO' || auth('sanctum')->user()->isAdmin() || auth('sanctum')->id() == $post->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Post $post)
    {
        return $post->user_id === auth('sanctum')->id()  || 
                auth('sanctum')->user()->role_id === \App\Models\Role::IS_ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Post $post)
    {
        return $post->user_id === auth('sanctum')->id() || 
                auth('sanctum')->user()->role_id === \App\Models\Role::IS_ADMIN;
    }

    public function postIt(User $user, Post $post)
    {
        return $post->status == 'BORRADOR' && (
                $post->user_id === auth('sanctum')->id() || 
                auth('sanctum')->user()->role_id === \App\Models\Role::IS_ADMIN
            ); 
    }
}
