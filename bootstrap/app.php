<?php

use App\Http\Middleware\CheckIsLogin;
use App\Http\Middleware\CheckRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Daftarkan middleware alias
        $middleware->alias([
            'auth.check' => CheckIsLogin::class,
            'role' => CheckRole::class,
        ]);

        // Middleware group untuk admin saja
        $middleware->group('admin', [
            'auth.check',
            'role:admin',
        ]);

        // Middleware group untuk user saja
        $middleware->group('user', [
            'auth.check',
            'role:user',
        ]);

        // Middleware group untuk semua yang sudah login (user & admin)
        $middleware->group('auth.all', [
            'auth.check',
            'role:user,admin',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
