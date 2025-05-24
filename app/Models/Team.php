<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class Team extends Model implements HasMedia
{
    /** @use HasFactory<TeamFactory> */
    use HasFactory,
        InteractsWithMedia,
        Notifiable;

    protected $fillable = [
        'name',
    ];

    public function gamesAsHost(): HasMany
    {
        return $this->hasMany(Game::class, 'host_id');
    }

    /**
     * Get the games where the team is the visitor.
     */
    public function gamesAsVisitor(): HasMany
    {
        return $this->hasMany(Game::class, 'visitor_id');
    }

    /**
     * Get all games where the team is either the host or the visitor.
     */
    public function games(): Collection
    {
        return $this->gamesAsHost()->union($this->gamesAsVisitor())->get();
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function leagues(): BelongsToMany
    {
        return $this->belongsToMany(League::class);
    }

    public function federations(): BelongsToMany
    {
        return $this->belongsToMany(Federation::class);
    }

    public function leagueSeasons(): BelongsToMany
    {
        return $this->belongsToMany(LeagueSeason::class, 'league_season_team')
            ->withPivot(['points', 'played', 'wins', 'draws', 'losses', 'scored', 'coincided'])
            ->withTimestamps();
    }

    public function currentLeagueSeason()
    {
        return $this->leagueSeasons()
            ->where('status', 'active')
            ->first();
    }

    public function twitch(): MorphOne
    {
        return $this->morphOne(Twitch::class, 'twitchable');
    }

    public function discord(): MorphOne
    {
        return $this->morphOne(Discord::class, 'discordable');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
