<?php

use App\Http\Middleware\ValidateAdminRole;
use App\Http\Middleware\ValidateApiKey;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('api-key', [
            ValidateApiKey::class
        ]);
        $middleware->appendToGroup('admin-role', [
            ValidateAdminRole::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
