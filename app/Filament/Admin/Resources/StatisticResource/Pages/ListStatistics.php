<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\StatisticResource\Pages;

use App\Filament\Admin\Resources\StatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListStatistics extends ListRecords
{
    protected static string $resource = StatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
