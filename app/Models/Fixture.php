<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\FixtureFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    /** @use HasFactory<FixtureFactory> */
    use HasFactory;

    public const HOUR = '22:00';

    public const WEEKDAY = 'Wednesday';

    public const WEEKEND_DAY = 'Sunday';

    protected $fillable = [
        'host_id',
        'visitor_id',
        'date',
    ];
}
