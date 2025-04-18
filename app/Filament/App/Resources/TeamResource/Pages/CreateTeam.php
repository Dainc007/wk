<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\TeamResource\Pages;

use App\Filament\App\Resources\TeamResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;

    protected static bool $canCreateAnother = false;

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user()->can('create_team') && auth()->user()->teams()->count() < 4;
    }

    private function afterCreate(): void
    {
        auth()->user()->teams()->attach($this->getRecord());
    }
}
