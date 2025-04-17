<?php

declare(strict_types=1);

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\TeamResource\Pages;
use App\Models\Team;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('teamLogo')
                    ->columnSpanFull()
                    ->avatar()
                    ->responsiveImages()
                    ->collection('teamLogos')
                    ->hiddenLabel()
                    ->alignCenter()
                    ->image()
                    ->imageEditor()
                    ->circleCropper()
                    ->directory('teamLogos')
                    ->disk('public'),
                TextInput::make('name')
                    ->required()->unique(ignoreRecord: true),
                //                TextInput::make('discord.name')
                //                    ->placeholder('Discord')
                //                    ->unique(ignoreRecord: true),
                //                TextInput::make('twitch.name')
                //                    ->placeholder('Twitch')
                //                    ->unique(ignoreRecord: true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->modifyQueryUsing(function (Builder $query): void {
            $query->whereHas('users', function (Builder $query): void {
                $query->where('users.id', auth()->id());
            });
        })
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),

            ])
            ->headerActions([
            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
        ];
    }

    // temporary
    public static function canAccess(): bool
    {
        return true;
    }

    public static function getNavigationLabel(): string
    {
        return __('My Teams');
    }

    public static function getLabel(): ?string
    {
        return __('My Teams');
    }
}
