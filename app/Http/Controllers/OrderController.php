<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order lists page
    public function list()
    {

        $orders = Order::with("user") // for lazyloading
            ->when(request()->search,function($query){
                $query->where("order_id","like","%".request()->search."%");
            })
            ->groupBy("order_id")
            ->orderBy("created_at", "desc")
            ->paginate(5);
        return view("admin.order.list", compact("orders"));
    }

    // detail order list
    public function detail($order_id)
    {
        $orders = Order::with("user", "product")->where("order_id", $order_id)->get();
        $paymentHistory = PaymentHistory::where("order_id", $order_id)->first();
        return view("admin.order.detail", compact("orders", "paymentHistory"));
    }
}
