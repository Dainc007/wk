<?php

declare(strict_types=1);

namespace App\Enums;

enum LeagueRegion: string
{
    case Domestic = 'domestic';
    case International = 'international';
    case Continental = 'continental';
}
