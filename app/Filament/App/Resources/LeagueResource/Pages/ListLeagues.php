<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\LeagueResource\Pages;

use App\Filament\App\Resources\LeagueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListLeagues extends ListRecords
{
    protected static string $resource = LeagueResource::class;

    protected static ?string $title = '';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
