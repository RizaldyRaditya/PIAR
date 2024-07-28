<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\vendingmachine;
use Illuminate\Http\Request;

class VendingMachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendingMachines = vendingmachine::with('products')->get();
        return response()->json($vendingMachines);
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
            'machineCode'=>'required',
            'machineName'=>'required',
            'note'=>'sometimes'
        ]);

        vendingmachine::create($req->all());

        if($req){
            return Response()->json(['message' => 'vendingmachine Successfully Created']);
        } else {
            return Response()->json(['message' => 'vendingmachine Failed to Create']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vendingMachines = vendingmachine::find($id);

        if ($vendingMachines) {
            return response()->json($vendingMachines);
        } else {
            return response()->json(['status' => 0, 'message' => 'vendingMachines not found'], 404);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
