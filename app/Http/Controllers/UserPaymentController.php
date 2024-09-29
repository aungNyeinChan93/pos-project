<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPaymentController extends Controller
{
    //payment page
    public function paymentPage(){
        $orders = Order::select("products.name","products.price","orders.amount")
        ->leftJoin("products","products.id","orders.product_id")
        ->where("orders.user_id",Auth::user()->id)
        ->get();
        // dd($orders);
        return view("user.product.payment",compact("orders"));
    }
}
