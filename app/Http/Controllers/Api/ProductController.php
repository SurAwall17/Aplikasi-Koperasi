<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json([
            "status" => true,
            "message" => "Data Ditemukan",
            "data" => $product
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Data gagal ditambahkan",
                "errors" => $validator->errors()
            ], 422);
        }

        $product = Product::create($request->all());
        return response()->json([
            "status" => true,
            "message" => "Data Berhasil Ditambahkan",
            "data" => $product
        ],201);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => 'required',
            "email" => 'required'
        ]);

        $product = Product::find($id);
        $product->update($request->all());

        if($validator->fails()){
            return response()->json([
                "status" => false,
                "message" => "Data gagal di ubah",
                "errors" => $validator->errors()
            ], 422);
        }

        return response()->json([
            "status" => true,
            "message" => "Data berhasil di ubah",
            "data" => $product

        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json([
            "status" => true,
            "message" => "Data berhasil dihapus"
        ],204);
    }
}
