<?php namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;

class CartController extends Controller
{
    public function addtocart(CartRequest $request)
    {
        $attributes = $request->validated();
        $check = Cart::where('product_id', $attributes['product_id'])->first();
        if($check)
        {
            Cart::where('product_id', $attributes['product_id'])->increment('quantity');
            return response(['message' => 'Quantity of the product have been increased by 1']);
        }
        else
        {
            Cart::create($attributes);
            return response(['message' => 'Product Added to cart']);
        }
    }
}
