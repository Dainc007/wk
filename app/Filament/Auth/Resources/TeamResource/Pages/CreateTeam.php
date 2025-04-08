<?php

declare(strict_types=1);

namespace App\Filament\Auth\Resources\TeamResource\Pages;

use App\Filament\Auth\Resources\TeamResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;
}
