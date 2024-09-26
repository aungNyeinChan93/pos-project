<?php

use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::prefix('users')->group(function () {
//     Route::get("/index",[UserController::class,"index"])->name("userHome");
// });


Route::group(["prefix"=>"users","middleware"=>["auth","user"]],function(){
    Route::get("/home",[UserController::class, "index"])->name("userHome");

    // profile
    Route::get("profile",[UserProfileController::class,"show"])->name("profile#showpage");
    Route::get("profile/edit",[UserProfileController::class, "edit"])->name("profile#editUser");
    Route::put("profile/update",[UserProfileController::class, "update"])->name("profile#updateUser");
    Route::get("profile/passwordChangePage",[UserProfileController::class, "passwordChangePage"])->name("profile#passwordChangePage");
    Route::put("profile/passwordUpdate",[UserProfileController::class, "passwordUpdate"])->name("profile#passwordUpdate");
});

