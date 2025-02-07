<?php
declare(strict_types=1);

namespace App\Models;

use Database\Factories\LeagueFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    /** @use HasFactory<LeagueFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'level',
        'country'
    ];
}
