<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\TeamUserResource\Pages;

use App\Filament\Admin\Resources\TeamUserResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateTeamUser extends CreateRecord
{
    protected static string $resource = TeamUserResource::class;
}
