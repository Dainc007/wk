<?php

declare(strict_types=1);

namespace App\Filament\App\Widgets;

use App\Models\Team;
use App\Models\User;
use App\Services\UserService;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

final class StatsOverview extends BaseWidget
{
    protected string|int|array $columnSpan = 1;

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

            Stat::make('Users Count', User::count())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

        ];
    }
}
