<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\StatisticTypeResource\Pages;

use App\Filament\Admin\Resources\StatisticTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditStatisticType extends EditRecord
{
    protected static string $resource = StatisticTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
