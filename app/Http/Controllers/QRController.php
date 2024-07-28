<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function generate()
    {
        // Generate QR code URL using the route helper
        $url = route('authenticate');

        // Create QR code
        $qrCode = QrCode::size(300)->generate($url);
        $base64QrCode = base64_encode($qrCode);

        // Log session data for debugging
        Log::info('Generated QR Code', ['url' => $url, 'session' => Session::all()]);

        // Display QR code in a view along with the URL
        //return view('qrcode', compact('qrCode', 'url'));
        return response()->json(["qrcode" => $base64QrCode]);
    }

    public function authenticate()
    {
        // Display the authentication page
        return view('authenticate');
    }
    
    public function generateToken(Request $request)
    {
        // Generate a new order token
        $orderToken = Str::random(32);
        Session::put('order_token', $orderToken);

        // Log session data for debugging
        Log::info('Generated Order Token', [
            'order_token' => $orderToken,
            'session' => Session::all()
        ]);

        // Return the order token for display
        return response()->json(['orderToken' => $orderToken]);
    }

    public function order() {
        return view('order-page');
    }

}
