<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Route::prefix('admins')->group(function () {
//     Route::get("/index",[AdminController::class,"index"])->name("adminHome");
// });

Route::get("admins/home",[AdminController::class, "index"])->name("adminHome");
