<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\TeamUserResource\Pages;

use App\Filament\Admin\Resources\TeamUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListTeamUsers extends ListRecords
{
    protected static string $resource = TeamUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
