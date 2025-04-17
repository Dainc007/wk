<?php

declare(strict_types=1);

namespace App\Filament\Auth\Pages;

use App\Filament\Auth\Resources\UserResource;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

final class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('account')->schema([
                    UserResource::getAvatarFileUploadComponent(),
                    $this->getNameFormComponent(),
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                    ]),

                Section::make('profile')->schema([
                    UserResource::getPlatformComponent(),
                    UserResource::getPlatformUsername(),
                    UserResource::getRecommendedByComponent()->disabledOn('edit'),
                    UserResource::getDiscordComponent(),
                    UserResource::getTwitchComponent(),
                ])
            ]);
    }
}
