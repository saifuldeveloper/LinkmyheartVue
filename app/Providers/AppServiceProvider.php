<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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
        Vite::prefetch(concurrency: 3);
        Inertia::share([
            'canLogin' => fn() => Route::has('login'),
            'canRegister' => fn() => Route::has('register'),
            'authProfile' => fn() => auth()->check()
                ? Profile::where('user_id', auth()->id())->first()
                : null,
            'flash' => function () {
                return [
                    'message' => session('message'),
                ];
            },
        ]);
    }
}
