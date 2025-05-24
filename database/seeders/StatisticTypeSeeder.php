<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\StatisticType;
use Illuminate\Database\Seeder;

final class StatisticTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statisticsData = [];

        // Process team statistics
        $teamStats = json_decode(file_get_contents(database_path('data/statistics.json')), true);
        foreach ($teamStats as $category => $data) {
            foreach ($data['statistics'] as $statistic) {
                $statisticsData[] = [
                    'name' => $statistic['name'],
                    'value_type' => $statistic['type'],
                    'description' => $statistic['description'],
                    'type' => 'game',
                ];
            }
        }

        // Process player statistics
        $playerStats = json_decode(file_get_contents(database_path('data/player-statistics.json')), true);
        foreach ($playerStats as $category => $data) {
            foreach ($data['statistics'] as $statistic) {
                $statisticsData[] = [
                    'name' => $statistic['name'],
                    'value_type' => $statistic['type'],
                    'description' => $statistic['description'],
                    'type' => 'player',
                ];
            }
        }

        // Insert all statistics in a single query
        StatisticType::insertOrIgnore($statisticsData);
    }
}
