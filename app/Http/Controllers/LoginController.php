<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login(Request $req) {
        Log::info('Login method triggered');
        $req->validate([
            'username_or_email' => 'required',
            'password' => 'required'
        ]);
        // Log::info('Raw request data:', $req->all());

        $credentials = $req->only('username_or_email', 'password');
        $user = User::where('username',$credentials['username_or_email'])
        ->orWhere('email',$credentials['username_or_email'])
        ->first();

        if($user && Hash::check($credentials['password'], $user->password)) {
           $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
               'message' => 'Login successful',
                'token' => $token
            ]);
            // Log::info('token:', $token);
        } else {
            return response()->json([
                'message' => 'Invalid username/email or password'
            ], 401);
        }
    }

    public function logout(Request $req) {
        $req->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logout successful'
    ]);
    }
}
