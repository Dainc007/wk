<?php

declare(strict_types=1);

namespace App\Filament\App\Widgets;

use App\Models\Twitch;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

final class LatestStreamers extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Twitch::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('twitchable.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->url(fn ($record): string => Twitch::getProfileUrl($record->name))
                    ->openUrlInNewTab(),
                Tables\Columns\IconColumn::make('is_live')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_live')
                    ->query(fn (Builder $query): Builder => $query->where('is_live', true)),
            ]);
    }
}
