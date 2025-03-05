<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\Countries;
use App\Filament\Resources\LeagueResource\Pages;
use App\Models\League;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class LeagueResource extends Resource
{
    protected static ?string $model = League::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Country Name'),
                Select::make('country')
                    ->required()
                    ->label('Country Code')
                    ->options(array_column(Countries::cases(), 'value', 'name'))
                    ->searchable(),
                TextInput::make('level')
                    ->required()
                    ->numeric()
                    ->label('Level'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Country Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('country')
                    ->label('Country Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('level')
                    ->label('Level')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeagues::route('/'),
            'create' => Pages\CreateLeague::route('/create'),
            'edit' => Pages\EditLeague::route('/{record}/edit'),
        ];
    }
}
