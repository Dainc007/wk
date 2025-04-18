<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\EventResource\Pages;

use App\Filament\App\Resources\EventResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
}
