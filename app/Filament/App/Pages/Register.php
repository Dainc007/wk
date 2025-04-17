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
                UserResource::getPlatformComponent(),
                UserResource::getPlatformUsername(),
                UserResource::getRecommendedByComponent(),
                UserResource::getDiscordComponent(),
                UserResource::getTwitchComponent(),
            ]);
    }
}
