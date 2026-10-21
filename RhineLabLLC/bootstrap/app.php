<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Jika berjalan di Vercel, arahkan base storage ke /tmp agar writable
$basePath = dirname(__DIR__);
if (isset($_ENV['VERCEL']) || getenv('VERCEL')) {
    $app = new Application($basePath);
    $app->useStoragePath('/tmp/storage');
} else {
    $app = Application::configure(basePath: $basePath)
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
        })->create();
}

return $app;
