<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController2 extends Controller
{
    // show page
    public function show()
    {
        return view("admin.profile.changePassword_show");
    }

    // password change
    public function change(Request $request)
    {
        $this->passwordValidation($request);
        // dd($request->all());

        if (Hash::check($request->currentPassword, Auth::user()->password)) {

            User::where("id","=",request()->user()->id)->update([
                "password"=>Hash::make($request->newPassword),
            ]);

            Alert::alert('Password Change', 'Password Change Success!' );
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect("/");

        }else{
            Alert::alert('Fail', 'Password Changing failed! ,Try again...' );
            return back();
        }


    }

    // Profile Page
    public function profilePage(){
        return view("admin.profile.userprofile_show");
    }


    // passwordValidation
    private function passwordValidation($request)
    {
        $request->validate([
            "currentPassword" => "required",
            "newPassword" => "required|min:6|max:15",
            "confirmPassword" => "required|same:newPassword"
        ]);
    }
}
