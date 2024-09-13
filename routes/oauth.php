<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get("auth/{provider}/redirect", function ($provider) {
    return Socialite::driver($provider)->redirect();
})->name("OAuth.redirect");

Route::get("auth/{provider}/callback", function ($provider) {
    $user = Socialite::driver($provider)->user();
    // dd($user);
    $user = User::updateOrCreate([
        'provider_id' => $user->id,
    ], [
        'name' => $user->name,
        'nicKName' => $user->nickname,
        'email' => $user->email,
        'provider_token' => $user->token,
        "provider"=>$provider,
    ]);
    Auth::login($user);
    return to_route("userHome");
})->name("OAuth.callback");
