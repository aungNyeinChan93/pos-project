<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //contact page
    public function index(){
        return view("user.contact.index");
    }

    // create contact message
    public function create(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            "user_id"=>"required",
            "title"=>"required",
            "message"=>"required"
        ]);

        $contact = Contact::create($validated);

        return to_route("userHome")->with("contact","You have success contacted message to admin ");

    }
}
