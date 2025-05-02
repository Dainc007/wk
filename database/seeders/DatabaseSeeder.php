<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\TeamUser;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ShieldSeeder::class,
            UserSeeder::class,
            TeamSeeder::class,
            FederationSeeder::class,
            LeagueSeeder::class,
            FederationLeagueTeamSeeder::class,
            LeagueSeasonSeeder::class,
            TwitchSeeder::class,
            TeamUserSeeder::class,
        ]);
    }
}
