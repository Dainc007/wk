<?php

declare(strict_types=1);

namespace App\Filament\Auth\Resources\TeamResource\Pages;

use App\Filament\Auth\Resources\TeamResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditTeam extends EditRecord
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
