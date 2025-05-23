<?php

declare(strict_types=1);

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\FederationResource\Pages;
use App\Filament\App\Resources\FederationResource\RelationManagers;
use App\Filament\Traits\HasActiveIcon;
use App\Filament\Traits\HasTranslatedLabels;
use App\Models\Federation;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class FederationResource extends Resource
{
    use HasActiveIcon,
        HasTranslatedLabels;

    protected static ?string $model = Federation::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->withCount('leagues')
                //                ->withCount('teams')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('region'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('leagues_count')
                    ->badge()
                    ->color('primary'),
                //                Tables\Columns\TextColumn::make('teams_count')
                //                    ->badge()
                //                    ->color('success'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            RelationManagers\LeaguesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFederations::route('/'),
            'create' => Pages\CreateFederation::route('/create'),
            'view' => Pages\ViewFederation::route('/{record}'),
            'edit' => Pages\EditFederation::route('/{record}/edit'),
        ];
    }

    // temporary
    public static function canAccess(): bool
    {
        return true;
    }
}
