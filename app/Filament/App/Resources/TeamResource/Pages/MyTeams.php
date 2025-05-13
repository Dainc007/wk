<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\TeamResource\Pages;

use App\Filament\App\Resources\TeamResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

final class MyTeams extends ListRecords
{
    protected static string $resource = TeamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        $user = auth()->user();
        
        return parent::table($table)
            ->query(
                $user->teams()->exists() 
                    ? $user->teams->toQuery()
                    : TeamResource::getEloquentQuery()->where('id', null)
            );
    }
}
