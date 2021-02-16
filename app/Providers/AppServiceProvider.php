<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $level = Auth::user()->level;
                $username = Auth::user()->name;
                $userid = Auth::user()->id;
            } else {
                $level = '';
                $username = '';
                $userid = '';
            }

            $view->with([
                'level' => $level,
                'username' => $username,
                'userid' => $userid
            ]);
        });
    }
}
