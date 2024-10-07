<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    // list comment page
    public function index(){
        $comments = Comment::orderBy("created_at","desc")->paginate(6);
        // dd($comments);
        return view("admin.comment.index",compact("comments"));
    }

    // comment delete
    public function delete(Comment $comment){
        $comment->delete();
        return back()->with("comment-del","Comment delete success!");
    }

    // comment detail
    public function detail(Request $request ,Comment $comment){
        return view("admin.comment.detail",compact("comment"));
    }
}
