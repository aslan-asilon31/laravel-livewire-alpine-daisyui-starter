<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\HakAkses;
use App\Policies\HakAksesKebijakan;
use Illuminate\Support\Facades\Gate;

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
        // \Illuminate\Support\Facades\Auth::shouldUse('pegawai');
        Gate::policy(HakAkses::class, HakAksesKebijakan::class);
    }
}
