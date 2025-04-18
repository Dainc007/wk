<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\LeagueResource\Widgets;

use App\Models\League;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

final class LeagueTableWidget extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->query(
                League::query()->with('teams')
            )
            ->columns([
                // ...
            ]);
    }
}
