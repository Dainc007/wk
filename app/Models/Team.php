<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\TeamFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Team extends Model
{
    /** @use HasFactory<TeamFactory> */
    use HasFactory;

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
}
