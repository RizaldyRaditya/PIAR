<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckOrderSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the order session exists
        $orderSession = Session::get('order_session');

        // Log session data for debugging
        Log::info('Middleware check', ['orderSession' => $orderSession, 'session' => Session::all()]);

        if (!$orderSession) {
            // Session is not valid, clear the session and redirect to QR code generation
            Session::forget('order_session');
            Session::forget('order_token');
            return redirect()->route('generate.qrcode')->with('error', 'Please scan the QR code again.');
        }

        return $next($request);
    }
}

