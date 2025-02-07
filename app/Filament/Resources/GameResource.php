<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameResource\Pages;
use App\Models\Game;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GameResource extends Resource
{
    protected static ?string $model = Game::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('host_id')
                    ->label('Host Team')
                    ->relationship('host', 'name')
                    ->required(),
                Forms\Components\Select::make('visitor_id')
                    ->label('Visitor Team')
                    ->relationship('visitor', 'name')
                    ->required(),
                Forms\Components\TextInput::make('host_score')
                    ->label('Host Score')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('visitor_score')
                    ->label('Visitor Score')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('host.name')
                    ->label('Host Team')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('score')
                    ->label('Score')
                    ->getStateUsing(function ($record) {
                        return $record->host_score.' : '.$record->visitor_score;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('visitor.name')
                    ->label('Visitor Team')
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
            'index' => Pages\ListGames::route('/'),
            'create' => Pages\CreateGame::route('/create'),
            'edit' => Pages\EditGame::route('/{record}/edit'),
        ];
    }
}
