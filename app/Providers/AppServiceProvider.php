<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                // Mengambil data user profile berdasarkan id user yang sedang login
                $user_profile = DB::table('users')->where('id', Auth::id())->first();

                // Membagikan variabel $user_profile ke semua view
                $view->with('user_profile', $user_profile);
            }
        });
    }
}
