<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\FederationResource\Pages;

use App\Filament\App\Resources\FederationResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateFederation extends CreateRecord
{
    protected static string $resource = FederationResource::class;
}
