<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\League;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

final class FederationLeagueTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        League::all()->each(function (League $league) {
            Team::paginate(20)->each(function ($team) use ($league) {
                $users = User::factory(11)->create();
                $team->users()->attach($users);
                $league->teams()->attach($team->id);
                $league->federation()->associate($team->id);
            });
        });
    }
}
