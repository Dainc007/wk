<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Enums\Countries;
use App\Filament\Traits\HasTranslatedLabels;
use App\Models\League;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class LeagueResource extends Resource
{
    use HasTranslatedLabels;

    protected static ?string $model = League::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationGroup = 'Competitions';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('logo'),
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
            'index' => LeagueResource\Pages\ListLeagues::route('/'),
            'create' => LeagueResource\Pages\CreateLeague::route('/create'),
            'edit' => LeagueResource\Pages\EditLeague::route('/{record}/edit'),
        ];
    }
}
