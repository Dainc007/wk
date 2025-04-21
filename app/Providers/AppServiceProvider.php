<?php

namespace App\Providers;

use App\Models\User;
use App\Services\LogService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
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

        Model::shouldBeStrict($isProduction);
        DB::prohibitDestructiveCommands($isProduction);
        URL::forceScheme('https');

        date_default_timezone_set(config('app.timezone'));

        LogService::shouldLogMissingTranslationKeys(config('logging.logMissingTranslationKeys'));

        Vite::prefetch(concurrency: 3)->useAggressivePrefetching();

        Gate::define('viewPulse', fn(User $user): bool => $user->isAdmin());
    }
}
