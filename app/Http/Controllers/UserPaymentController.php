<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserPaymentController extends Controller
{
    //payment page
    public function paymentPage(){
        // dd(Session::get("orderLists"));
        $payments = Payment::get();
        $orderLists = Session::get("orderLists");
        // dd($orderLists);

        return view("user.product.payment",compact("payments","orderLists"));


    }

    // order product
    public function order(Request $request){
        dd($request->all());
    }
}

// $orders = Order::select("products.name","products.price","orders.amount")
// ->leftJoin("products","products.id","orders.product_id")
// ->where("orders.user_id",Auth::user()->id)
// ->get();
// dd($orders);
