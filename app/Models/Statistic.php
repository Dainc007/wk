<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Statistic extends Model
{
    public function statisticable(): MorphTo
    {
        return $this->morphTo();
    }
}
