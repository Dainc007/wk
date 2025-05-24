<?php

declare(strict_types=1);

namespace App\Filament\App\Resources;

use App\Enums\DefaultSettings;
use App\Enums\SocialPlatform;
use App\Filament\App\Resources\UserResource\Pages;
use App\Filament\Traits\HasActiveIcon;
use App\Filament\Traits\HasTranslatedLabels;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class UserResource extends Resource
{
    use HasActiveIcon,
        HasTranslatedLabels;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $recordTitleAttribute = 'name';

    protected static bool $shouldRegisterNavigation = false;

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
            ->columns([
                TextColumn::make('name')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }

    public static function getAvatarFileUploadComponent(): SpatieMediaLibraryFileUpload
    {
        return SpatieMediaLibraryFileUpload::make('avatars')
            ->responsiveImages()
            ->collection('avatars')
            ->conversion('thumb')
            ->hiddenLabel()
            ->alignCenter()
            ->image()
            ->imageEditor()
            ->circleCropper()
            ->avatar()
            ->directory('avatars')
            ->disk('public');
    }

    public static function canAccess(): bool
    {
        return auth()->user()->can('view_any_user');
    }

    public static function getPlatformComponent(): \Filament\Forms\Components\Component
    {
        return Select::make('platform')
            ->label('Platform')
            ->options([
                'Playstation' => 'Playstation',
                'Xbox' => 'Xbox',
                'PC' => 'PC',
            ])
            ->reactive();
    }

    public static function getPlatformUsername(): \Filament\Forms\Components\Field
    {
        return TextInput::make('platform_username')
            ->label(function (callable $get): string {
                $platform = $get('platform');
                switch ($platform) {
                    case 'Xbox':
                        return 'GamerTag';
                    case 'PC':
                        return 'Origin';
                    case 'Playstation':
                        return 'PlayStation Network';
                    default:
                        return 'Username';
                }
            })
            ->prefix(function (callable $get): string {
                $platform = $get('platform');

                return match ($platform) {
                    'Xbox' => '🎮',
                    'PC' => '💻',
                    'Playstation' => '🎮',
                    default => '',
                };
            })
            ->hidden(fn (callable $get): bool => empty($get('platform')));
    }

    public static function getDiscordComponent(): Grid
    {
        return Grid::make('discord')
            ->relationship('discord')
            ->schema([
                TextInput::make('name')
                    ->label('Discord Username')
                    ->suffix(fn (): \Illuminate\Support\HtmlString => new \Illuminate\Support\HtmlString(DefaultSettings::DiscordIcon->value))
                    ->maxLength(255),
            ]);
    }

    public static function getTwitchComponent(): Grid
    {
        return Grid::make('twitch')
            ->relationship('twitch')
            ->schema([
                TextInput::make('name')
                    ->prefix(SocialPlatform::TWITCH->getBaseUrl())
                    ->label('Twitch Username')
                    ->suffix(fn (): \Illuminate\Support\HtmlString => new \Illuminate\Support\HtmlString(DefaultSettings::TwitchIcon->value))
                    ->maxLength(255),
            ]);
    }

    public static function getRecommendedByComponent(): Select
    {
        // todo needs optimization
        return Select::make('recommended_by')
            ->label('Recommended By')
            ->options(User::all()->pluck('name', 'id'))
            ->searchable()
            ->preload()
            ->placeholder('Search for user who recommended you');
    }
}
