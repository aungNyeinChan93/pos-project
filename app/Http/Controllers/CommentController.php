<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    // delete comment
    public function delete(Comment $comment){
        Gate::authorize("delete",$comment);
        $comment->delete();
        return back();
    }
}
