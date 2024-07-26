<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $req)
    {
        $req->validate([
            'productCategoryId' => 'required',
            'productName' => 'required',
            'productPrice' => 'required',
            'productStock' => 'required',
            'productImage' => 'required|image|max:2048'
        ]);

        $data = $req->all();
        if($req->hasFile('productImage')) {
            $path = $req->file('productImage')->store('public/image/products');
            $data['productImage'] = basename($path);
        }

        $data['productCreatedUserId'] = auth()->user()->userId;


        $product = Product::create($data);

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
    public function update(Request $req, string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $req->validate([
                'productCategoryId' => 'sometimes',
                'productName' => 'sometimes',
                'productPrice' => 'sometimes',
                'productStock' => 'sometimes',
                'productImage' => 'sometimes|image|max:2048'
            ]);

            $data = $req->all();
            if($req->hasFile('productImage')) {
                if($product->productImage){
                    Storage::delete('public/image/products' . $product->productImage);
                }
                $path = $req->file('productImage')->store('public/image/products');
                $data['productImage'] = basename($path);
            }

            $data['productModUserId'] = auth()->user()->userId;
            $product->update($data);

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
            if($product->productImage){
                Storage::delete('public/image/products' . $product->productImage);
            }
            $product->delete();
            return response()->json(['status' => 1, 'message' => 'Product deleted successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Product not found'], 404);
        }
    }
}

