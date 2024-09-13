<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->route()->getName()); ## Can get route name

        # Auth -> Route::login/register -> denie/close
        # user->role is user ->
        # !Auth -> Route::login/register -> accept/denie

        if(Auth::user()){
            if($request->user()->role == "user"){
                if($request->route()->getName() == "register" || $request->route()->getName() == "login"){
                    abort(403);
                }else{
                    return $next($request);
                }
            }else{
                abort(403);
            }
        }else{
            return $next($request);
        }
    }
}
