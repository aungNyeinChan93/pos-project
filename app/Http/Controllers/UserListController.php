<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserListController extends Controller
{
    // user  list
    public function list(){
        // dd(request()->searchKey);
        $users = User::select(["id","name","nickName","email","phone","role","created_at","provider"])
                    ->where("role","user")
                    ->when(request()->searchKey,function($query){
                        $query->whereAny(["name","email","phone","address","role","provider"],"like","%".request()->searchKey."%");
                    })
                    ->paginate(7);
        return view("admin.userList.list",compact("users"));
    }

    // user delete
    public function delete(User $user){
        $user->delete();
        Alert::alert('User Account Delete', 'Delete Success!' );
        return back();
    }
}
