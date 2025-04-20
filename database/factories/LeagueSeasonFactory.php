<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\League;
use App\Models\LeagueSeason;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LeagueSeason>
 */
final class LeagueSeasonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = $this->faker->numberBetween(2020, 2023);
        $nextYear = $year + 1;
        $season = $year.'/'.$nextYear;

        $startDate = $this->faker->dateTimeBetween("$year-08-01", "$year-09-15");
        $endDate = $this->faker->dateTimeBetween("$nextYear-05-01", "$nextYear-06-30");

        return [
            'league_id' => League::factory(),
            'season' => $season,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $this->faker->randomElement(['upcoming', 'active', 'completed']),
        ];
    }

    /**
     * Indicate the season is active
     */
    public function active(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
            ];
        });
    }

    /**
     * Indicate the season is completed
     */
    public function completed(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
            ];
        });
    }

    /**
     * Indicate the season is upcoming
     */
    public function upcoming(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'upcoming',
            ];
        });
    }

    /**
     * Create current season (2023/2024)
     */
    public function currentSeason(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'season' => '2023/2024',
                'start_date' => '2023-08-15',
                'end_date' => '2024-05-30',
                'status' => 'active',
            ];
        });
    }
}
