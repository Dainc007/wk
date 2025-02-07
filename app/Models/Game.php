<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\GameFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    /** @use HasFactory<GameFactory> */
    use HasFactory;

    protected $fillable = [
        'host_id',
        'visitor_id',
        'host_score',
        'visitor_score',
    ];

    /**
     * Get the host team.
     */
    public function host(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'host_id');
    }

    /**
     * Get the visitor team.
     */
    public function visitor(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'visitor_id');
    }
}
