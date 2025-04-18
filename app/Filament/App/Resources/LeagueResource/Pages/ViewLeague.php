<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\LeagueResource\Pages;

use App\Filament\App\Resources\LeagueResource;
use App\Filament\App\Resources\LeagueResource\Widgets\LeagueTableWidget;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

final class ViewLeague extends ViewRecord
{
    protected static string $resource = LeagueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            LeagueTableWidget::make(),
        ];
    }
}
