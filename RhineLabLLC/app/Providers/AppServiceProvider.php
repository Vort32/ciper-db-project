<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- Tambahkan baris ini di atas

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paksa semua URL asset/vite jadi HTTPS agar tidak kena Mixed Content di Vercel
        if (isset($_ENV['VERCEL']) || getenv('VERCEL')) {
            URL::forceScheme('https');
        }
    }
}
