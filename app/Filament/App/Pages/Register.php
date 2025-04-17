<?php

declare(strict_types=1);

namespace App\Filament\App\Pages;

use App\Filament\App\Resources\UserResource;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as FilamentRegister;

final class Register extends FilamentRegister
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
            ]);
    }

}
