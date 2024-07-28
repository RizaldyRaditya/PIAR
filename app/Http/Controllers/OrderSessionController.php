<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ordersession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderSessionController extends Controller
{
    public function createSession()
    {
        $token = Str::random(60);
        OrderSession::create(['token' => $token]);

        return response()->json(['token' => $token], 201);
    }

    
}
