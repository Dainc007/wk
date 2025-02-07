<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'host_id' => Team::inRandomOrder()->first()->id,
            'visitor_id' => Team::inRandomOrder()->first()->id,
            'host_score' => rand(0, 5),
            'visitor_score' => rand(0, 5),
        ];
    }
}
