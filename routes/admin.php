<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController2;

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
        Route::get("admin/create",[ProfileController2::class, "createPage"])->name("profile#adminAccCreate");
        Route::post("admin/create",[ProfileController2::class, "create"])->name("profile#adminAccCreateAction");

    });

    // Payment
    Route::prefix("payment")->group(function(){
        Route::get("list",[PaymentController::class,"list"])->name("payment#list");
        Route::post("create",[PaymentController::class,"create"])->name("payment#create");
        Route::get("edit/{payment}",[PaymentController::class,"edit"])->name("payment#edit");
        Route::put("update/{payment}",[PaymentController::class,"update"])->name("payment#update");

    });



});

