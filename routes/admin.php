<?php

use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController2;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\adminListController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleInfoController;

Route::group(["prefix" => "admins", "middleware" => ["admin"]], function () {
    Route::get("home", [AdminController::class, "index"])->name("adminHome")->middleware("admin");

    // category
    Route::group(["prefix"=>"categories"],function(){
        Route::get("list",[CategoryController::class,"list"])->name("category#list");
        Route::post("create",[CategoryController::class,"create"])->name("category#create");
        Route::get("edit/{category}",[CategoryController::class,"edit"])->name("category#edit");
        Route::put("update/{category}",[CategoryController::class,"update"])->name("category#update");
        Route::delete("delete/{category}",[CategoryController::class,"delete"])->name("category#delete");
    });

    // Profile
    Route::prefix("profile")->group(function(){
        Route::get("passwordChangePage",[ProfileController2::class,"show"])->name("password#show");
        Route::put("passwordChang",[ProfileController2::class,"change"])->name("password#change");
        Route::get("profilePage",[ProfileController2::class, "profilePage"])->name("profile#page");
        Route::get("edit",[ProfileController2::class, "edit"])->name("profile#edit");
        Route::put("update",[ProfileController2::class, "update"])->name("profile#update");
        Route::middleware('superadmin')->group(function () {
            Route::get("admin/create",[ProfileController2::class, "createPage"])->name("profile#adminAccCreate");
            Route::post("admin/create",[ProfileController2::class, "create"])->name("profile#adminAccCreateAction");
       });
    });

    // Payment
    Route::group(["prefix"=>"payment","middleware"=>"superadmin"],function(){
        Route::get("list",[PaymentController::class,"list"])->name("payment#list");
        Route::post("create",[PaymentController::class,"create"])->name("payment#create");
        Route::get("edit/{payment}",[PaymentController::class,"edit"])->name("payment#edit");
        Route::put("update/{payment}",[PaymentController::class,"update"])->name("payment#update");
        Route::get("delete/{payment}",[PaymentController::class,"delete"])->name("payment#delete");

    });

    // admin List
    Route::group(["middleware"=>"superadmin","prefix"=>"adminList"],function(){
        Route::get("list",[adminListController::class,"list"])->name("adminList#index");
        Route::get("delete/{user}",[adminListController::class,"delete"])->name("adminList#delete");

    });

    // user list
    Route::group(["middleware"=>"superadmin","prefix"=>"userList"],function(){
        Route::get("list",[UserListController::class,"list"])->name("userList#index");
        Route::get("delete/{user}",[UserListController::class,"delete"])->name("userList#delete");

    });

    // Product List
    Route::group(["prefix"=>"products"],function(){
        Route::get("createPage",[ProductController::class,"createPage"])->name("product#createPage");
        Route::post("create",[ProductController::class,"create"])->name("product#create");
        Route::get("listPage/{amount?}",[ProductController::class,"listPage"])->name("product#listPage");
        Route::get("detail/{product}",[ProductController::class,"detail"])->name("product#detail");
        Route::get("edit/{product}",[ProductController::class,"edit"])->name("product#edit");
        Route::put("update/{product}",[ProductController::class,"update"])->name("product#update");
        Route::delete("delete/{product}",[ProductController::class,"delete"])->name("product#delete");

    });

    // order
    Route::group(["prefix"=>"orders"],function(){
        Route::get("list",[OrderController::class,"list"])->name("order#list");
        Route::get("detail/{order_id}",[OrderController::class,"detail"])->name("order#detail");
        Route::get("changeStatus",[OrderController::class,"changeStatus"]);
        Route::post("orderConfrim/{order_id}",[OrderController::class, "orderConfirm"])->name("order#orderConfirm");
        Route::post("orderReject/{order_id}",[OrderController::class, "orderReject"])->name("order#orderReject");
    });

    // Sale Information
    Route::group(["prefix"=>"saleInfo"],function(){
        Route::get("page",[SaleInfoController::class,"infoPage"])->name("saleInfo#page");
        Route::get("detail/{order_id}",[SaleInfoController::class,"detail"])->name("saleInfo#detail");
    });

    // contact info
    Route::group(["prefix"=>"contact"],function(){
        Route::get("index",[AdminContactController::class,"index"])->name("adminContact#index");
        Route::delete("delete/{contact}",[AdminContactController::class,"delete"])->name("adminContact#delete");
    });

    // comment
    Route::get("comment",[AdminCommentController::class,"index"])->name("adminComment#index");
    Route::post("comment/{comment}",[AdminCommentController::class,"detail"])->name("adminComment#detail");
    Route::delete("comment/{comment}",[AdminCommentController::class,"delete"])->name("adminComment#delete");


});

