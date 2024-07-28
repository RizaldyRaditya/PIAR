<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\vendingmachine;
use Illuminate\Http\Request;

class VendingMachineProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::with('vendingMachines')->get();
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
            'productId' => 'required|exists:product,productId',
            'machineId' => 'required|exists:vendingmachines,machineId',
            'productStock' => 'required',
        ]);

        $product = Product::find($request->productId);
        $vendingMachine = vendingmachine::find($request->machineId);

        $product->vendingMachines()->attach($vendingMachine->machineId, ['productStock' => $request->productStock]);

        return response()->json(['message' => 'Product stock added successfully'], 201);
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
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'machineId' => 'required|exists:vendingmachines,machineId',
            'productStock' => 'required|min=0',
        ]);

        $vendingMachine = VendingMachine::find($request->machineId);
        $product->vendingMachines()->updateExistingPivot($vendingMachine->machineId, ['productStock' => $request->productStock]);

        return response()->json(['message' => 'Product stock updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
