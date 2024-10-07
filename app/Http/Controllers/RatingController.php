<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    // user rating create
    public function create(Request $request){
        // dd($request->all());
        Rating::updateOrCreate([
            "product_id" => $request->product_id,
        ],[
            "user_id"=>Auth::user()->id,
            "count"=> $request->rating
        ]);
        return back()->with("rating","You have $request->rating star rated now!");
        
    }
}
