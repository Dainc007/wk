<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ActivityLogResource\Pages;

use App\Filament\Admin\Resources\ActivityLogResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateActivityLog extends CreateRecord
{
    protected static string $resource = ActivityLogResource::class;
}
