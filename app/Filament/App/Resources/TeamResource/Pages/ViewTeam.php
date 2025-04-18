<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\TeamResource\Pages;

use App\Filament\App\Resources\TeamResource;
use App\Filament\App\Widgets\CalendarWidget;
use App\Filament\App\Widgets\LatestStreamers;
use App\Filament\App\Widgets\StatsOverview;
use App\Filament\App\Widgets\UserPlayedGamesWidget;
use Filament\Resources\Pages\ViewRecord;

final class ViewTeam extends ViewRecord
{
    protected static string $resource = TeamResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            StatsOverview::class,
            UserPlayedGamesWidget::class,
            LatestStreamers::class,
            CalendarWidget::class,
        ];
    }
}
