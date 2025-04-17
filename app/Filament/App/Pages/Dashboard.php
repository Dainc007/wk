<?php

declare(strict_types=1);

namespace App\Filament\Auth\Pages;

use App\Filament\Auth\Widgets\StatsOverview;
use App\Filament\Auth\Widgets\UserPlayedGamesWidget;
use Filament\Pages\Page;

final class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.app.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            UserPlayedGamesWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
        ];
    }
}
