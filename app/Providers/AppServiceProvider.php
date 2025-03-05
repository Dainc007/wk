<?php

namespace App\Providers;

use App\Models\User;
use BezhanSalleh\FilamentShield\FilamentShield;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

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
        $isProduction = $this->app->isProduction();

        Vite::prefetch(concurrency: 3);

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });

        FilamentShield::prohibitDestructiveCommands($isProduction);

        Gate::guessPolicyNamesUsing(function (string $modelClass) {
            return str_replace('Models', 'Policies', $modelClass).'Policy';
        });

        // todo to do usunięcia
        Gate::before(function ($user, $ability) {
            $isSuperAdmin = $user->hasRole('super-admin');
            $isFirstUser = $user->id === 1;

            return $isSuperAdmin || $isFirstUser ? true : null;
        });
    }
}
