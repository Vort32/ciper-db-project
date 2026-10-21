<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Arahkan storage dan cache ke /tmp khusus untuk lingkungan Vercel serverless
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    });

// Redirect cache path to /tmp on Vercel
if (getenv('VERCEL')) {
    $app::useStoragePath('/tmp/storage');
}

return $app;
