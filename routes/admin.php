<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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
    });



});

