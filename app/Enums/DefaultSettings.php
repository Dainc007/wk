<?php

declare(strict_types=1);

namespace App\Enums;

use Illuminate\Support\Facades\Storage;

enum DefaultSettings: string
{
    case AvatarUrl = 'images/default_avatar.png';

    public function getUrl(): string
    {
        return match ($this) {
            self::AvatarUrl => Storage::disk('public')->url($this->value),
        };
    }
}
