<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;

class SaleInfoController extends Controller
{
    // sale infomation page
    public function infoPage()
    {
        $orders = Order::with("user","product")->where("status", 1)
            ->groupBy("order_id")
            ->orderBy("created_at", "desc")
            ->get();


        return view("admin.saleInformation.index", compact("orders"));
    }

    // sale info detail page
    public function detail($order_id)
    {

        $orders = Order::with("user","product")->where("order_id", $order_id)
            ->orderBy("created_at", "desc")
            ->get();

        $paymentHistory = PaymentHistory::where("order_id",$order_id)->first();

        // dd($paymentHistory);
        return view("admin.saleInformation.detail",compact("orders","paymentHistory"));

    }
}
