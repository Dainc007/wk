<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\App\Auth\Login;
use App\Filament\App\Auth\Register;
use App\Filament\App\Pages\EditProfile;
use App\Filament\AvatarProviders\BoringAvatarsProvider;
use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use MarcoGermani87\FilamentCookieConsent\FilamentCookieConsent;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;

final class AppPanelProvider extends PanelProvider
{
    /**
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->topNavigation(true)
            ->spa()
            ->default()
            ->id('app')
            ->path('app')
            ->login(Login::class)
            ->registration(Register::class)
            ->defaultAvatarProvider(BoringAvatarsProvider::class)
            ->profile(EditProfile::class)
            ->passwordReset()
            ->emailVerification()
            ->databaseTransactions()
            ->databaseNotifications()
            ->databaseNotificationsPolling('10s')
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'primary' => Color::Fuchsia,
            ])
            ->discoverResources(in: app_path('Filament/App/Resources'), for: 'App\\Filament\\App\\Resources')
            ->resources([
            ])
            ->discoverPages(in: app_path('Filament/App/Pages'), for: 'App\\Filament\\App\\Pages')
            ->pages([
                //                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/App/Widgets'), for: 'App\\Filament\\App\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                GlobalSearchModalPlugin::make(),
                FilamentCookieConsent::make(),
                FilamentFullCalendarPlugin::make(),
                //                    ->schedulerLicenseKey()
                //                    ->selectable()
                //                    ->editable()
                //                    ->timezone()
                //                    ->locale()
                //                    ->plugins()
                //                    ->config()
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
