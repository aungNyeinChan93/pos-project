<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProductController extends Controller
{
    //product List
    public function list()
    {
        $products = Product::all();
        if (!$products) {
            return response()->json([
                "message" => "Empty data!"
            ], 433);
        }
        return response()->json([
            "message" => "Product Lists succes!",
            "products" => $products,
        ], 200);
    }

    // cart_product delete
    public function cartDelete(Request $request)
    {
        // logger($request->cartId);
        // logger($products);
        $cart_id = $request->cartId;
        $cart = Cart::findOrFail($cart_id)->delete();
        $products = Cart::where("user_id",Auth::user()->id)->get();
        return response()->json([
            "message"=>"Cart Delete success",
            "products"=> $products,
        ],200);
    }
}
