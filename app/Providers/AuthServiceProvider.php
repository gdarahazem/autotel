<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::createUrlUsing(function ($user, string $token) {

            if ($user instanceof Admin) {
                return route('admin.password.reset', [
                    'token' => $token,
                    'email' => $user->email
                ]);
            }
            if ($user instanceof User) {
                return route('password.reset', [
                    'token' => $token,
                    'email' => $user->email
                ]);
            }

        });
    }
}
