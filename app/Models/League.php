<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LeagueFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class League extends Model
{
    /** @use HasFactory<LeagueFactory> */
    use HasFactory;

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function federation(): BelongsTo
    {
        return $this->belongsTo(Federation::class);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(LeagueSeason::class);
    }

    public function currentSeason()
    {
        return $this->seasons()
            ->where('status', 'active')
            ->first();
    }
}
