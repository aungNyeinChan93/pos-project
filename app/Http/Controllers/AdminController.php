<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Contact;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;

class AdminController extends Controller
{
    //
    public function index(){

        $total_products = Order::where("status",1)->groupBy("product_id")->orderBy("amount","desc")->get();
        // dd($total_products);

        $total_sale = number_format(PaymentHistory::sum("total_amount"));
        // dd($total_sale);

        $total_users = User::where("role","user")->count();
        // dd($total_users);

        $total_contact =Contact::count();
        // dd($total_contact);

        $total_comment = Comment::count();
        // dd($total_comment);

        return view("admin.home.index",compact("total_products","total_sale","total_users","total_contact","total_comment"));
    }
}
