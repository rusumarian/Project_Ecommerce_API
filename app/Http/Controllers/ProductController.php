<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRegisterRequest;
use App\Http\Requests\ProductUpdateRequest;
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
        $products = collect(Product::all());
        return response()->json(compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(ProductRegisterRequest $request)
    {
        $attributes = $request->validated();
        $attributes['slug'] = Str::slug($attributes['title'], '-');
        if($attributes['quantity'] > 0)
        {
            $attributes['in stock'] = `1`;
        }
        else
        {
            $attributes['in stock'] = `0`;
        }
        $product = Product::create($attributes);
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($slug)
    {
        return response()->json(Product::where('slug', $slug)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $attributes = $request->validated();
        $attributes['slug'] = Str::slug($attributes['title'], '-');
        if($attributes['quantity'] > 0)
        {
            $attributes['in stock'] = true;
        }
        else
        {
            $attributes['in stock'] = false;
        }
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
