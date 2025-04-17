<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

final class TeamUser extends Pivot
{
    protected $table = 'team_user';
}
