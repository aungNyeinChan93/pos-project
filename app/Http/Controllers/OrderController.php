<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    //order lists page
    public function list()
    {

        $orders = Order::with("user") // for lazyloading
            ->when(request()->search, function ($query) {
                $query->where("order_id", "like", "%" . request()->search . "%");
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

    // order status change
    public function changeStatus(Request $request)
    {
        // logger($request->all());
        $order = Order::where("order_id", $request->order_id)->update([
            "status" => $request->status,
        ]);

        return response()->json([
            "message" => "success",
        ], 200);

    }

    // order confirm
    public function orderConfirm(Request $request, $order_id)
    {
        // dd($order_id);
        $orders = Order::with("user", "product")->where("order_id", $order_id)->get();
        // dd($orders->toArray());

        $orders->map(function ($order) use ($order_id) {
            if ($order->status == 0) {
                Order::where("order_id", $order_id)->update([
                    "status" => 1,
                ]);
                Product::where("id", $order->product->id)->decrement("stock", $order->amount);
                Alert::alert('Order Confirm', 'Order Confirmation Success!');
            } else {
                Alert::alert('Alert', 'Only pending status need to confirm order');
            }
        });

        return to_route("order#list");

    }

    // order reject
    public function orderReject(Request $request, $order_id)
    {
        $orders = Order::with("user", "product")->where("order_id", $order_id)->get();
        $orders->map(function ($order) use ($order_id) {
            $order->where("order_id", $order_id)->update([
                "status" => 2,
            ]);
        });
        Alert::alert('Reject Orders', 'Order was Rejected ');
        return to_route("order#list");
    }
}
