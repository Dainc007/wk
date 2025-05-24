<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class LeagueTeam extends Pivot
{
    protected $table = 'league_team';
}
