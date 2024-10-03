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
            ->groupBy("order_id")
            ->orderBy("created_at", "desc")
            ->paginate();
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
