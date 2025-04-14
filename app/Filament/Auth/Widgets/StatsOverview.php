<?php

declare(strict_types=1);

namespace App\Filament\Auth\Widgets;

use App\Models\Team;
use App\Services\UserService;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users Online', UserService::getActiveUsersCount())
                ->description('Total number of users online')
                ->descriptionIcon(
                    'heroicon-m-arrow-trending-up',
                    IconPosition::After
                )->color('success'),

            Stat::make('Registered Teams', Team::count())
                ->description('Total number of registered teams')
                ->descriptionIcon(
                    'heroicon-m-arrow-trending-up',
                    IconPosition::After
                )->color('warning'),

            Stat::make('Unique views', '192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),


        ];
    }
}
