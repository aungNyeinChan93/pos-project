<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserPaymentController extends Controller
{
    //payment page
    public function paymentPage()
    {
        // dd(Session::get("orderLists"));
        $payments = Payment::get();
        $orderLists = Session::get("orderLists");
        return view("user.product.payment", compact("payments", "orderLists"));
    }

    // order product
    public function order(Request $request)
    {
        $request->validate([
            "name" => "required",
            "phone" => "required",
            "address" => "required",
            "payment" => "required",
            "payment_image" => "required",
        ]);

        $paymentHistoriesData = [
            "user_name" => $request->name,
            "user_phone" => $request->phone,
            "user_address" => $request->address,
            "payment_method" => $request->payment,
            "order_id" => $request->order_id,
            "total_amount" => $request->total_amount,
        ];

        // action-log
        ActionLog::create([
            "user_id"=>Auth::user()->id,
            "product_id"=>1,
            "action_status"=>"order-create"
        ]);


        // create payment history
        if ($request->hasFile("payment_image")) {
            $fileName = uniqid() . $request->file('payment_image')->getClientOriginalName();
            $request->file("payment_image")->move(public_path() . "/paymentSlip/", $fileName);
            $paymentHistoriesData["payment_image"] = $fileName;
        }
        // dd($paymentHistoriesData);
        PaymentHistory::create($paymentHistoriesData);

        // cart_session data delete
        Session::forget("count_Cart");

        // create order
        $orderLists = Session::get("orderLists");

        foreach ($orderLists as $order) {
            Order::create([
                "user_id" => $order["user_id"],
                "order_id" => $order["order_id"],
                "product_id" => $order["product_id"],
                "amount" => $order["amount"],
                "status" => $order["status"],
            ]);

            // cart old data clear
            Cart::orWhere("user_id", $order["user_id"])
                ->orWhere("product_id", $order["product_id"])
                ->delete();
        }

        return to_route("payment#orderList");

    }
    // order list
    public function orderList()
    {
        $orders = Order::where("user_id", Auth::user()->id)
            ->groupBy("order_id")
            ->orderBy("created_at", "desc")
            ->get();
        return view("user.product.orderList",compact("orders"));
    }

    // order detail
    public function detail($order_id){
        $orders = Order::where("order_id",$order_id)->get();
        $totalAmount = PaymentHistory::where("order_id",$order_id)->first("total_amount");
        // dd($totalAmount->total_amount);
        return view("user.product.orderDetail",compact("orders","totalAmount"));
    }
}




















// $orders = Order::select("products.name","products.price","orders.amount")
// ->leftJoin("products","products.id","orders.product_id")
// ->where("orders.user_id",Auth::user()->id)
// ->get();
// dd($orders);
