<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // comment create
    public function create(Request $request){
        // dd($request->all());
        Comment::create([
            "product_id"=>$request->product_id,
            "user_id"=> Auth::user()->id,
            "comment"=>$request->comment,
        ]);

        
        return back();
    }
}
