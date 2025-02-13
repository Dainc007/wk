<?php

namespace App\Providers;

use App\Models\User;
use App\Services\LogService;
use Illuminate\Database\Eloquent\Model;
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
        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes();
        Model::preventAccessingMissingAttributes();

        LogService::shouldLogMissingTranslationKeys(config('logging.logMissingTranslationKeys'));

        Vite::prefetch(concurrency: 3);

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin();
        });
    }
}
