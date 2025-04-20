<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class Discord extends Model
{
    public function discordable(): MorphTo
    {
        return $this->morphTo();
    }
}
