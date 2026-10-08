<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/auth.php',   // <-- Breeze auth routes
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // If your Laravel 7 app used custom middleware aliases
        // (from the old Http/Kernel.php $routeMiddleware array),
        // register them here, e.g.:
        //
        // $middleware->alias([
        //     'admin'     => \App\Http\Middleware\AdminMiddleware::class,
        //     'checkRole' => \App\Http\Middleware\CheckRole::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
