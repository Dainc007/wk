<?php

declare(strict_types=1);

namespace App\Filament\App\Widgets;

use Filament\Widgets\ChartWidget;

final class UserPlayedGamesWidget extends ChartWidget
{
    protected static ?string $heading = 'Games Played';

    protected static ?string $pollingInterval = null;

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        // Random game statistics
        $wins = 30;
        $draws = 50;
        $losses = 20;

        $total = $wins + $draws + $losses;

        // Calculate percentages
        $winPercentage = round(($wins / $total) * 100);
        $drawPercentage = round(($draws / $total) * 100);
        $lossPercentage = round(($losses / $total) * 100);

        return [
            'datasets' => [
                [
                    'label' => 'Game Results',
                    'data' => [$wins, $draws, $losses],
                    'backgroundColor' => ['#10B981', '#F59E0B', '#EF4444'],
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ["Wins ($winPercentage%)", "Draws ($drawPercentage%)", "Losses ($lossPercentage%)"],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
