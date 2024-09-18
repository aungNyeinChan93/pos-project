<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    // payment list
    public function list(){
        $payments= Payment::orderBy("id","desc")->paginate();
        return view("admin.payment.list",compact("payments"));
    }

    // create payment
    public function create(Request $request){
        $this->paymentValidation($request);
        Payment::create([
            "account_name"=> $request->accName,
            "account_number"=> $request->accNumber,
            "account_type"=> $request->accType,
        ]);
        Alert::alert('Create Payment', 'Create Payment Account Success' );
        return back();

    }

    // edit payment page
    public function edit(Payment $payment){
        return view("admin.payment.edit",compact("payment"));
    }

    // update payment
    public function update(Request $request , Payment $payment){
        $this->paymentValidation($request);
        $payment->update([
            "account_name"=>$request->accName,
            "account_number"=>$request->accNumber,
            "account_type"=>$request->accType,
        ]);
        Alert::alert('Update Payment', 'Update Payment Account Success' );
        return to_route("payment#list");

    }

    #######################
    private function paymentValidation($request){
        $request->validate([
            "accName" => "required",
            "accNumber" => "required",
            "accType" => "required",
        ]);

    }
}
