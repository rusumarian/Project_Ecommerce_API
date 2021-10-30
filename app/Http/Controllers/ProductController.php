<?php namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $product = Product::latest()->filter(request([
            'search',
            'in-stock',
            'out-of-stock',
            'price-min',
            'price-max',
            'category',
            'color'
        ]))->get();
        return response()->json($product);
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
