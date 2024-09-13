<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::prefix('users')->group(function () {
//     Route::get("/index",[UserController::class,"index"])->name("userHome");
// });


Route::group(["prefix"=>"users","middleware"=>["auth","user"]],function(){
    Route::get("/home",[UserController::class, "index"])->name("userHome");
});

