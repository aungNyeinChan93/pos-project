<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\superAdminMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "test"=> App\Http\Middleware\TestingMiddelware::class,
            "user"=> App\Http\Middleware\UserMiddleware::class,
            "admin"=> App\Http\Middleware\AdminMiddleware::class,
            "myGuest"=> App\Http\Middleware\MyguestMiddleware::class,
            "superadmin"=> superAdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
