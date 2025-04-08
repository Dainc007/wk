<?php

declare(strict_types=1);

namespace App\Filament\Auth\Pages;

use App\Filament\Auth\Resources\UserResource;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

final class Register extends \Filament\Pages\Auth\Register
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                UserResource::getAvatarFileUploadComponent()->placeholder(__('Place For Your Avatar')),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getPlatformComponent(),
                $this->getPlatformUsername(),
                $this->getRecommendedByComponent(),
                $this->getDiscordComponent(),
                $this->getTwitchComponent(),
            ]);
    }

    private function getPlatformComponent(): \Filament\Forms\Components\Component
    {
        return Select::make('platform')
            ->label('Platform')
            ->options([
                'Playstation' => 'Playstation',
                'Xbox' => 'Xbox',
                'PC' => 'PC',
            ])
            ->required()
            ->reactive();
    }

    private function getPlatformUsername(): \Filament\Forms\Components\Field
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
            ->hidden(fn (callable $get): bool => empty($get('platform')))
            ->required(fn (callable $get): bool => ! empty($get('platform')));
    }

    private function getDiscordComponent(): \Filament\Forms\Components\TextInput
    {
        return TextInput::make('discord')
            ->label('Discord Username')
            ->prefix('ⓓ')
            ->maxLength(255);
    }

    private function getTwitchComponent(): \Filament\Forms\Components\TextInput
    {
        return TextInput::make('twitch')
            ->label('Twitch Username')
            ->prefix('ⓣ') // Twitch icon representation
            ->maxLength(255);
    }

    private function getRecommendedByComponent(): Select
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
