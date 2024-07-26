<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\productCategory;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productC= productCategory::all();
        return Response()-> json($productC);
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
            'productCategoryName'=>'required'
        ]);

        productCategory::create($req->all());

        if($req){
            return Response()->json(['status'=> 1]);
        } else {
            return Response()->json(['status'=> 0]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productC = productCategory::find($id);

        if ($productC) {
            return response()->json($productC);
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
        $productC = productCategory::find($id);

        if ($productC) {
            $req->validate([
                'productCategoryName'=>'required'
            ]);

            $productC->update($req->all());
            Log::info('Request data:', $req->all());

            return response()->json(['status' => 1, 'message' => 'Product Category updated successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Product Category not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productC = productCategory::find($id);

        if ($productC) {
            $productC->delete();
            return response()->json(['status' => 1, 'message' => 'Product deleted successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Product not found'], 404);
        }
    }
}
