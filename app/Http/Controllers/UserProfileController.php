<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserProfileController extends Controller
{
    // show profile page
    public function show()
    {
        $user = User::find(Auth::user()->id);
        // dd($user);
        return view("user.profile.showPage");
    }

    // edit profile page
    public function edit()
    {
        return view("user.profile.editPage");
    }

    // update userProfile process
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email," . Auth::user()->id,
            "phone" => "nullable",
            "address" => "nullable",
        ]);

        if ($request->hasFile("image")) {
            if (Auth::user()->profile_image != null) {
                if (file_exists(public_path("/profile/" . Auth::user()->profile_image))) {
                    unlink(public_path("/profile/" . Auth::user()->profile_image));
                }
            }
            $fileName = $request->file("image")->getClientOriginalName();
            $request->file("image")->move(public_path() . "/profile/", $fileName);
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "profile_image" => $fileName,
            ]);

        } else {
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
            ]);
        }
        Alert::alert('Profile Update', 'Profile Update Success');
        return to_route("profile#showpage");
    }

    // user password change page
    public function passwordChangePage()
    {
        return view("user.profile.passwordChangePage");
    }

    // update user password
    public function passwordUpdate(Request $request)
    {
        // dd(User::find(Auth::user()->id));
        $request->validate([
            "currentPassword" => "required",
            "password" => "required|confirmed|different:currentPassword",
            "password_confirmation" => "required|same:password",
        ]);
        if (Hash::check($request->currentPassword, Auth::user()->password)) {
            User::find(Auth::user()->id)->update([
                "password" => $request->password,
            ]);
            Alert::alert('Password Update', 'Password Update Success');
            return to_route("profile#showpage");
        } else {
            return back();
        }
    }
}
