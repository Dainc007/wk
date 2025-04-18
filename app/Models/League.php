<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\LeagueFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class League extends Model
{
    /** @use HasFactory<LeagueFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'country',
    ];

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
