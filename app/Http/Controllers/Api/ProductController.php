<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::latest()->get());
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|integer',
    //         'stock' => 'required|integer',
    //         'rating' => 'nullable|integer',
    //         'discount' => 'nullable|integer',
    //         'link' => 'nullable|url',
    //         'description' => 'nullable|string'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     $product = Product::create($request->all());
    //     return new ProductResource($product);
    // }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    // public function update(Request $request, Product $product)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|integer',
    //         'stock' => 'required|integer',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     $product->update($request->all());
    //     return new ProductResource($product);
    // }

    // public function destroy(Product $product)
    // {
    //     $product->delete();
    //     return response()->noContent();
    // }
}
