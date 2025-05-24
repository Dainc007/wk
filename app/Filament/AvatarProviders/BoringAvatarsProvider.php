<?php

declare(strict_types=1);

namespace App\Filament\AvatarProviders;

use Filament\AvatarProviders\Contracts;
use Illuminate\Database\Eloquent\Model;

final class BoringAvatarsProvider implements Contracts\AvatarProvider
{
    public function get(Model $record): string
    {
        return $record->getFilamentAvatarUrl();
    }
}
