<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\order;
use App\Models\orderProduct;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = order::all();
        return response()->json($order);
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
            'productId' => 'required',
            'qty' => 'required'
        ]);

        $product = product::findOrFail($req['productId']);
        $totalPrice = $product->productPrice * $req['qty'];

        $order = order::create([
            'totalPrice' => $totalPrice,
            'status' => 'Belum terbayarkan',
            'orderNumber' => Str::random(10)
        ]);


        orderProduct::create([
            'orderId' => $order->orderId,
            'productId' => $product->productId,
            'productName' => $product->productName,
            'price' => $product->productPrice,
            'qty' => $req->input('qty'),
            'totalPrice' => $totalPrice
        ]);

        $order->update(['totalPrice' => $totalPrice]);

        return response()->json(['orderId' => $order->orderId, 'message' => 'Order Successfully Created'],404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = order::find($id);

        if ($order) {
            $order->delete();
            return response()->json(['status' => 1, 'message' => 'Order deleted successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Order not found'], 404);
        }
    }
}
