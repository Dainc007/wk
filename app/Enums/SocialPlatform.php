<?php

declare(strict_types=1);

namespace App\Enums;

enum SocialPlatform: string
{
    case TWITCH = 'twitch';

    public function getBaseUrl(): string
    {
        return match ($this) {
            self::TWITCH => 'https://www.twitch.tv/',
        };
    }
}
