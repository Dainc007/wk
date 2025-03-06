<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\LeagueResource\Pages;

use App\Filament\Admin\Resources\LeagueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditLeague extends EditRecord
{
    protected static string $resource = LeagueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
