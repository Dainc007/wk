<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\FederationResource\Pages;

use App\Filament\App\Resources\FederationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

final class ListFederations extends ListRecords
{
    protected static string $resource = FederationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
