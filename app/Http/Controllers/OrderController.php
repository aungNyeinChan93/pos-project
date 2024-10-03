<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order lists page
    public function list()
    {
        $orders = Order::with("user")
                ->groupBy("order_id")
                ->orderBy("created_at", "desc")
                ->paginate();
        return view("admin.order.list", compact("orders"));
    }
}
