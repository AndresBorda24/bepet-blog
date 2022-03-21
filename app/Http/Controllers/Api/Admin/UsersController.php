<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);
        
        return UserResource::collection(User::all());
    }

    /**
     * Change user role
     */
    public function changeRole(User $user, Request $request)
    {
        $this->authorize('changeRole', $user);

        $validated = $request->validate([
            'role' => ['required', 'exists:roles,id', 'confirmed']
        ]);

        $user->update(['role_id' => $validated['role']]);

        return (new UserResource($user))->additional([
            'message' => "User's Role has been successfully updated :3"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }
}
