<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\GameResource\Pages;

use App\Filament\Admin\Resources\GameResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateGame extends CreateRecord
{
    protected static string $resource = GameResource::class;
}
