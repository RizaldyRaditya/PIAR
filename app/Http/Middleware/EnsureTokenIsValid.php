<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $req, Closure $next): Response
    {
        Log::info('EnsureTokenIsValid middleware triggered for route: ' . $req->path());
        if (!$req->bearerToken()) {
            return response()->json(['message' => 'Token missing'], 401);
        }
        if (Auth::guard('sanctum')->user() == null) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        return $next($req);
    }
}
