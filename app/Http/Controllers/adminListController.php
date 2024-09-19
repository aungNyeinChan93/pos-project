<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class adminListController extends Controller
{
    // admin list
    public function list(){
        // dd(request()->searchKey);

        $admins = User::select(["id","name","nickName","email","phone","role","created_at","provider"])
                    // ->whereIn("role",["admin","superAdmin"])
                    ->when(request()->searchKey,function($query){
                        $query->whereAny(["name","email","phone","address","role","provider"],"like","%".request()->searchKey."%");
                    })
                    ->paginate(7);
        return view("admin.adminList.list",compact("admins"));
    }

    // adminlist delete
    public function delete(User $user){
        $user->delete();
        Alert::alert('User Account Delete', 'Delete Success!' );
        return back();
    }
}
