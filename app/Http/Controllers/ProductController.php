<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
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
    public function store(Request $request)
    {
        $request->validate([
            'productCategoryId' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productStock' => 'required'
        ]);

        $product = Product::create($request->all());

        if ($product) {
            return response()->json(['status' => 1, 'message' => 'Product Successfully Created']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Product Failed to Create']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json($product);
        } else {
            return response()->json(['status' => 0, 'message' => 'Product not found'], 404);
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
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $request->validate([
                'productCategoryId' => 'required',
                'productName' => 'required',
                'productPrice' => 'required',
                'productStock' => 'required'
            ]);

            $product->update($request->all());

            return response()->json(['status' => 1, 'message' => 'Product updated successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Product not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return response()->json(['status' => 1, 'message' => 'Product deleted successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Product not found'], 404);
        }
    }
}

