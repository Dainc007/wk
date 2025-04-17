<?php

declare(strict_types=1);

namespace App\Filament\Auth\Resources\UserResource\Pages;

use App\Filament\Auth\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
