<?php

namespace App\Providers;

use App\Models\Comment;
use App\Policies\CommnetPolicy;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // App::bind("key",function(): never{
        //     dd(vars: "test");
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();

    }

    // protected $policies = [
    //     Comment::class => CommnetPolicy::class,
    // ];
}
