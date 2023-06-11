<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the login request
        $credentials = $request->validate([
            'email' => 'required|email|string|exists:users,email',
            'password' => ['required'],
        ]);

        // Attempt to authenticate the staff member
        $credentials = $request->only('email', 'password');
        
        if (!Auth::attempt($credentials)) {
            return response([
                'error' => 'The provided Credentials are incorrect'
            ], 422);
        } else {
            $user = Auth::user();
            $token = $user->createToken('main')->plainTextToken;

            return response([
                'user' => $user,
                'token' => $token
            ]);
        }
    }
}
