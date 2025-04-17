<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\TeamResource\Pages;

use App\Filament\App\Resources\TeamResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;

    protected static bool $canCreateAnother = false;
}
