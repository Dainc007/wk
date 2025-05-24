<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\TeamResource\Pages;

use App\Filament\App\Resources\TeamResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

final class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;

    protected static bool $canCreateAnother = false;

    public static function canAccess(array $parameters = []): bool
    {
        return auth()->user()->can('create_team') && auth()->user()->teams()->count() < 4;
    }

    protected function afterCreate(): void
    {
        $user = auth()->user();
        $team = $this->getRecord();
        $user->teams()->attach($team);
        $user->notify(
            Notification::make()
                ->success()
                ->title('Team Created!')
                ->body($team->name.' has been created.')
                ->toDatabase()
        );
    }
}
