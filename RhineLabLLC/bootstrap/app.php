<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
    })->create();

// Jika berjalan di Vercel, arahkan path storage & cache ke /tmp agar writable
if (isset($_ENV['VERCEL']) || getenv('VERCEL')) {
    $app->useStoragePath('/tmp/storage');
    
    // Buat direktori esensial di /tmp jika belum ada
    $tmpStorage = '/tmp/storage';
    foreach (['framework/cache/data', 'framework/sessions', 'framework/views', 'logs'] as $dir) {
        if (!is_dir($tmpStorage . '/' . $dir)) {
            mkdir($tmpStorage . '/' . $dir, 0755, true);
        }
    }
}

return $app;
