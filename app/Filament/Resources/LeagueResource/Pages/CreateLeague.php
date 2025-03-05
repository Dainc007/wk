<?php

declare(strict_types=1);

namespace App\Filament\Resources\LeagueResource\Pages;

use App\Filament\Resources\LeagueResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateLeague extends CreateRecord
{
    protected static string $resource = LeagueResource::class;
}
