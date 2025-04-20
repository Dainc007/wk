<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

final class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $request = Http::withHeaders([
            'X-Auth-Token' => config('services.football_data.token'),
        ])->get('http://api.football-data.org/v4/teams/', ['limit' => 500]);

        if ($request->successful()) {
            $response = $request->json();
            $teams = [];
            foreach ($response['teams'] as $key => $team) {
                $teams[] = [
                    'name' => $team['name'],
                ];
            }
            Team::insert($teams);

        } else {
            Team::factory(500)->create();
        }
    }
}
