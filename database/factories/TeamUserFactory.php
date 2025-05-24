<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TeamUser>
 */
final class TeamUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, User::count()),
            'team_id' => rand(1, Team::count()),
            'pitch_role' => $this->faker->randomElement(['pitcher', 'catcher', 'first baseman', 'second baseman', 'third baseman', 'shortstop', 'left field', 'center field', 'right field']),
            'contract_signed_at' => now()->subMonths(rand(1, 12)),
            'contract_terminated_at' => now()->addDays(rand(1, 180)),
            'status' => 'active',
        ];
    }

    /**
     * Configure the factory to create multiple team users for a specific user
     * with chronologically ordered contracts
     *
     * @param  int  $userId  The user ID to create team history for
     * @param  int  $count  Number of teams to generate (default 3)
     */
    public function createUserTeamHistory(int $userId, int $count = 3): self
    {
        return $this->state(function (array $attributes) use ($userId) {
            // This will be overridden in the TeamUser::factory()->count()->sequence() call
            return [
                'user_id' => $userId,
            ];
        });
    }

    /**
     * Configure the factory to set a team user as inactive
     */
    public function inactive(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'inactive',
                'contract_terminated_at' => now()->subDays(rand(1, 90)),
            ];
        });
    }
}
