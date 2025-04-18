<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\DiscordFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class Discord extends Model
{
    /** @use HasFactory<DiscordFactory> */
    use HasFactory;
    
    public function discordable(): MorphTo
    {
        return $this->morphTo();
    }
}
