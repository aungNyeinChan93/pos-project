<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::group(["prefix" => "admins", "middleware" => ["admin"]], function () {
    Route::get("home", [AdminController::class, "index"])->name("adminHome")->middleware("admin");
});

