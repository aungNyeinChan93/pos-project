<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $products = Cart::where("user_id", Auth::user()->id)->get();
        return response()->json([
            "message" => "Cart Delete success",
            "products" => $products,
        ], 200);
    }

    // order products page
    public function orderPage(Request $request)
    {
        // logger($request->all());
        $orderArr = [];
        $orderLists = $request->order;
        logger($orderLists);
        foreach ($orderLists as $orderList) {
            array_push($orderArr, [
                "user_id" => $orderList["user_id"],
                "product_id" => $orderList["product_id"],
                "amount" => $orderList["qty"],
                "order_id" => $orderList["orderId"],
                "total_amount" => $orderList["total_amount"],
                "status" => 0,
            ]);
        }
        Session::put("orderLists", $orderArr);
        session()->forget("count_cart");


        return response()->json([
            "message" => "success",
        ], 200);
    }
}
