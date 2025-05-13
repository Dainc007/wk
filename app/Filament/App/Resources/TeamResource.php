<?php

declare(strict_types=1);

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\TeamResource\Pages;
use App\Filament\App\Resources\TeamResource\RelationManagers\UsersRelationManager;
use App\Filament\Traits\HasActiveIcon;
use App\Models\Team;
use Asmit\FilamentMention\Forms\Components\RichMentionEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

final class TeamResource extends Resource
{
    use HasActiveIcon;

    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 2;

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
                RichMentionEditor::make('description')
                    ->columnSpanFull()
                    ->disableGrammarly()
                    ->disableToolbarButtons([
                        'attachFiles',
                    ])
                    ->nullable(),
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
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('teamLogo')
                    ->circular()
                    ->collection('teamLogos'),
                TextColumn::make('name'),
            ])
            ->filters([

            ])
            ->actions([
                // todo all teams or own team?
                Tables\Actions\EditAction::make()->visible(auth()->user()->can('edit_team')),
                Tables\Actions\DeleteAction::make()->visible(auth()->user()->can('delete_team')),
                ViewAction::make()
            ])
            ->headerActions([
            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\MyTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            'edit' => Pages\EditTeam::route('/{record}/edit'),
            'view' => Pages\ViewTeam::route('/{record}'),
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

    public static function canCreate(): bool
    {
        return auth()->user()->can('create_team') && auth()->user()->teams()->count() < 2;
    }
}
