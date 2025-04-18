<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\SocialPlatform;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class Twitch extends Model
{

    use HasFactory;
    public static function getProfileUrl(string $profileName): string
    {
        return SocialPlatform::TWITCH->getBaseUrl().$profileName;
    }

    public function twitchable(): MorphTo
    {
        return $this->morphTo();
    }
}
