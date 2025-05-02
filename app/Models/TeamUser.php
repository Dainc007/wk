<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PitchRoles;
use Database\Factories\TeamUserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

final class TeamUser extends Pivot
{
    /** @use HasFactory<TeamUserFactory> */
    use HasFactory;

    protected $table = 'team_user';

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function casts(): array
    {
        return [
            'pitch_role' => PitchRoles::class
        ];
    }
}
