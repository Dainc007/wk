<?php

declare(strict_types=1);

namespace App\Filament\App\Pages;

use App\Filament\App\Resources\UserResource;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

final class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                UserResource::getAvatarFileUploadComponent(),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),

                UserResource::getPlatformComponent(),
                UserResource::getPlatformUsername(),
                UserResource::getRecommendedByComponent()->disabledOn('edit'),
                UserResource::getDiscordComponent(),
                UserResource::getTwitchComponent(),
            ]);
    }
}
