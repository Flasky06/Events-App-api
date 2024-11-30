<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Hash the password
        $fields['password'] = Hash::make($fields['password']);

        // Create a new user
        $user = User::create($fields);

        // Dispatch registered event
        event(new Registered($user));

        // Generate authentication token
        $token = $user->createToken($request->name);

        // Return response
        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ], 201);
    }
}
