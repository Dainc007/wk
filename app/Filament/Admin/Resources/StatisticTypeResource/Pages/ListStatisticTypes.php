<?php

namespace App\Filament\Admin\Resources\StatisticTypeResource\Pages;

use App\Filament\Admin\Resources\StatisticTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatisticTypes extends ListRecords
{
    protected static string $resource = StatisticTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
