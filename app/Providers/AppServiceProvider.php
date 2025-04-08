<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Services\LogService;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;
use BezhanSalleh\FilamentShield\FilamentShield;
use Filament\Actions\Action;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Field;
use Filament\Infolists\Components\Entry;
use Filament\Tables\Columns\Column;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
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

        $this->handleGates();
        $this->setFilamentConfiguration();
    }

    private function setDefaultFilamentSettings(): void
    {
        Column::configureUsing(function (Column $column): void {
            $column
                ->alignCenter()
                ->sortable()
                ->translateLabel();
        });
        Filter::configureUsing(function (Filter $filter): void {
            $filter->translateLabel();
        });
        Field::configureUsing(function (Field $field): void {
            $field->translateLabel();
        });
        Entry::configureUsing(function (Entry $entry): void {
            $entry->translateLabel();
        });

        Action::configureUsing(function (Action $action): void {
            $action->translateLabel();
        });

        Component::configureUsing(function (Component $component): void {
            $component->translateLabel();
        });
    }

    private function setFilamentConfiguration(): void
    {
        FilamentShield::prohibitDestructiveCommands($this->app->isProduction());

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch): void {
            $switch
                ->circular()
                ->locales(['pl', 'en']);
        });

        $this->setDefaultFilamentSettings();
    }

    private function handleGates(): void
    {
        Gate::before(function (User $user): bool {
            return $user->isSuperAdmin();
        });

        Gate::define('viewPulse', function (User $user): bool {
            return $user->isAdmin();
        });

        Gate::guessPolicyNamesUsing(function (string $modelClass) {
            return str_replace('Models', 'Policies', $modelClass).'Policy';
        });

        Gate::define('viewPulse', fn (User $user): bool => $user->isAdmin());
    }
}
