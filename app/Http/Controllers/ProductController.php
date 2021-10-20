<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $attributes = $request->validated();
        $attributes['in_stock'] = $attributes['quantity'] > 0 ? 1 : 0;
        $product = Product::create($attributes);
        return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $attributes = $request->validated();
        $attributes['in_stock'] = $attributes['quantity'] > 0 ? 1 : 0;
        $product->update($attributes);
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response(['message' => 'Product deleted!']);
    }
}
