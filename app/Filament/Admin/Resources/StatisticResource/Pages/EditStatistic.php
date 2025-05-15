<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\StatisticResource\Pages;

use App\Filament\Admin\Resources\StatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditStatistic extends EditRecord
{
    protected static string $resource = StatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
