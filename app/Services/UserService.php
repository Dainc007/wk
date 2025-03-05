<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

final class UserService
{
    public static function getActiveUsersCount(): int
    {
        return User::where('last_seen_at', '>=', now()->subMinutes(5))->count();
    }
}
