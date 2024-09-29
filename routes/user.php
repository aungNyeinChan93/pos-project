<?php

use App\Http\Controllers\Api\UserProductController as ApiUserProductController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPaymentController;
use App\Http\Controllers\UserProductController;

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

    // products
    Route::group(["prefix"=>"products"],function(){
        Route::get("detail/{product}",[UserProductController::class,"detail"])->name("userProduct#detail");
        Route::post("addCart",[UserProductController::class, "addCart"])->name("userProduct#addcart");
        Route::get("cartPage",[UserProductController::class, "cartPage"])->name("userProduct#cartPage");

        // Api for ajax request
        Route::get("list",[ApiUserProductController::class, "list"]);
        Route::get("cart/delete",[ApiUserProductController::class, "cartDelete"]);
        Route::get("orderPage",[ApiUserProductController::class, "orderPage"]);

        // payment
        Route::get("payment",[UserPaymentController::class,"paymentPage"])->name("paymentPage");

    });

});

