<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\League;
use Illuminate\Database\Seeder;

final class LeagueSeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        League::all()->each(function (League $league) {
            for ($seasonCount = 1; $seasonCount <= 3; $seasonCount++) {
                $status = ($seasonCount < 3) ? 'finished' : 'active';
                $season = $league->seasons()->create([
                    'status' => $status,
                    'season' => $seasonCount,
                ]);
                $rows = $league->teams->map(function ($team) use ($season) {
                    return [
                        'team_id' => $team->id,
                        'league_season_id' => $season->id
                    ];
                })->toArray();

                $season->table()->insert($rows);
            }
        });

    }
}
