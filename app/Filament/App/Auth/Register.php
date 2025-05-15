<?php

declare(strict_types=1);

namespace App\Filament\App\Auth;

use App\Filament\App\Resources\UserResource;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Auth\Register as FilamentRegister;
use Illuminate\Database\Eloquent\Model;

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

    protected function handleRegistration(array $data): Model
    {
        $user = $this->getUserModel()::create($data);
        $user->assignRole('user');
        $user->notify(
            Notification::make()
                ->success()
                ->title('Welcome!')
                ->body('Your account has been created. Now you can join a team or create new one! Have fun!')
                ->toDatabase()
        );

        $user->notify(
            Notification::make()
                ->warning()
                ->title('Note:')
                ->body('Your account is not verified yet. Please check your email for verification link.')
                ->toDatabase()
        );

        return $user;
    }
}
