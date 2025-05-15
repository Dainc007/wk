<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StatisticTypeResource\Pages;
use App\Filament\Traits\HasTranslatedLabels;
use App\Models\StatisticType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

final class StatisticTypeResource extends Resource
{
    use HasTranslatedLabels,
        HasTranslatedLabels;

    protected static ?string $model = StatisticType::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationGroup = 'Statistics';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'boolean' => 'Boolean',
                        'integer' => 'Integer',
                        'float' => 'Float',
                        'string' => 'String',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->nullable(),
                Forms\Components\Toggle::make('is_enabled')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('value_type'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\ToggleColumn::make('is_enabled'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_enabled')
                    ->options([
                        1 => 'Enabled',
                        0 => 'Disabled',
                    ]),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'game' => 'Game',
                        'player' => 'Player',
                    ]),
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
            'index' => Pages\ListStatisticTypes::route('/'),
            'create' => Pages\CreateStatisticType::route('/create'),
            'edit' => Pages\EditStatisticType::route('/{record}/edit'),
        ];
    }
}
