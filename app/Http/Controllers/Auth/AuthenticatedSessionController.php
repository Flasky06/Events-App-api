<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user ||!Hash::check($request->password,$user->password)){

            return response()->json(['message' => 'The provided credentials are incorrect.'], 401);

         }

          // Generate authentication token
        $token = $user->createToken($user->name);

        // Return response
        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ], 201);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
{
    $request->user()->tokens()->delete();

    // Return a success response
    return response()->json(['message' => 'You are logged out.']);
}

}