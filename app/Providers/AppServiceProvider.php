<?php

namespace App\Providers;

use App\Models\Configuration;
use Auth;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        try {
            $query = Configuration::all();
        } catch (Exception $exception) {
            Log::error($exception);
        }

        view()->composer('*', function ($view) use ($query) {
            $user = Auth::user();
            $guard_admin = Auth::guard("admin")->check();
            $guard_client = Auth::guard("web")->check();
            $logo = $query->where('label', "=", "logo")->first();
            $background = $query->where('label', "=", "background")->first();
            $view->with('user', $user);
            if ($guard_client) {
                $view->with('client', $user->client);
            }
            $view->with('guard_web', $guard_client);
            $view->with('guard_admin', $guard_admin);
            $view->with('background', $background->value);
            $view->with('logo', $logo->value);
            $view->with('user', Auth::user());

        });
    }
}
