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

    // Profile View Page
    public function edit(){
        return view("admin.profile.userprofile_edit");
    }

    // Profile update
    public function update(Request $request){
        $this->profileUpdateValidation($request);

        if(request()->hasFile("image")){
            if(Auth::user()->profile_image != null ){
                if( file_exists(public_path("/profile/".Auth::user()->profile_image))){
                    unlink(public_path("/profile/".Auth::user()->profile_image));
                }
            }

            $fileName =uniqid()."_anc_". request()->file("image")->getClientOriginalName();
            request()->file("image")->move(public_path()."/profile/",$fileName);
            User::where("id",Auth::user()->id)->update([
                "name"=> $request->name,
                "email"=> $request->email,
                "phone"=> $request->phone,
                "profile_image"=> $fileName,
            ]);
        }else{
            User::where("id",Auth::user()->id)->update([
                "name"=> $request->name,
                "email"=> $request->email,
                "phone"=> $request->phone,
                // "profile_image"=> Auth::user()->profile_image,
            ]);
        }
        Alert::alert('Profile Update', 'Profile Update Success' );
        return to_route("profile#page");
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

    // profileUpdateValidation
    private function profileUpdateValidation($request){
        $request->validate([
            "name"=> "required",
            "email"=> "required|email|unique:users,email,".Auth::user()->id,
            "phone"=> "min:6|max:15",
            "image"=> "mimes:jpeg,png,jpg,svg|max:2048"
        ]);
    }
}
