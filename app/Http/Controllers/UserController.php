<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('UserController index method triggered');
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8'
        ]);
        try {
            $user = User::create([
                'userId' => Str::random(10),
                'username' => $req->username,
                'email' => $req->email,
                'password' => Hash::make($req->password)
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'User creation failed',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        if ($user) {
            return response()->json([
                'message' => 'User found',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $userId)
    {
        $req->validate([
            'username' => 'sometimes',
            'email' => 'sometimes',
            'password' => 'sometimes|min:8'
        ]);

        $user = User::findOrFail($userId);

        if($user) {
            if($req->has('username')){
                $user->username = $req->username;
            }
            if($req->has('email')) {
                $user->email = $req->email;
            }
            if($req->has('password')) {
                $user->password = Hash::make($req->password);
            }

        $user->save();
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user
        ]);
        } else {
            return response()->json([
            'message' => 'User not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        if ($user) {
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
    }
}
