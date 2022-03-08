<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoggedUserResource;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (! auth()->attempt($credentials)){
            return response()->json(['error' => 'Invalid Credentials'], 422);
        }

        $user = User::where('email', $request->email)->firstOrfail();
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'auth-token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'LogOut succesfully!']);
    }
}
