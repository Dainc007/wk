<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

final class LeagueSeason extends Model
{
    use HasFactory;

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function teams(): HasManyThrough
    {
        return $this->hasManyThrough(
            Team::class,
            LeagueTable::class,
            'league_season_id', // Foreign key on league_tables table
            'id',               // Foreign key on teams table
            'id',               // Local key on league_seasons table
            'team_id'           // Local key on league_tables table
        );
    }

    public function fixtures(): HasMany
    {
        return $this->hasMany(Fixture::class);
    }

    public function table(): HasMany
    {
        return $this->hasMany(LeagueTable::class);
    }
}
