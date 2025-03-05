<?php

declare(strict_types=1);

namespace App\Filament\Resources\TeamResource\Pages;

use App\Filament\Resources\TeamResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;
}
