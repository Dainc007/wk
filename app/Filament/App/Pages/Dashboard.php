<?php

declare(strict_types=1);

namespace App\Filament\App\Pages;

use App\Filament\App\Widgets\CalendarWidget;
use App\Filament\App\Widgets\LatestStreamers;
use App\Filament\App\Widgets\NextEventWidget;
use App\Filament\App\Widgets\StatsOverview;
use App\Filament\App\Widgets\UserPlayedGamesWidget;
use App\Filament\Traits\HasActiveIcon;
use Filament\Pages\Page;

final class Dashboard extends Page
{
    use HasActiveIcon;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.app.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            NextEventWidget::class,
            UserPlayedGamesWidget::class,
            LatestStreamers::class,
            CalendarWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
        ];
    }

    private function getColumns(): int
    {
        return 3;
    }

    public static function getNavigationLabel(): string
    {
        return __('filament.pages.dashboard');
    }
}
