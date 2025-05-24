<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\PitchRoles;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use Illuminate\Database\Seeder;

final class TeamUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamsCount = Team::count();
        User::all()->each(function ($user) {
            $teamCount = rand(0, 10);

            $startDate = now()->subMonths(rand(12, 36));

            $sequence = [];

            for ($i = 0; $i < $teamCount; $i++) {
                // The last record should be active, all others inactive
                $isLast = ($i === $teamCount - 1);

                // Create chronological dates for each team
                $contractSigned = $startDate->copy()->addMonths($i * 6);
                $contractTerminated = $isLast ? null : $contractSigned->copy()->addMonths(rand(3, 5));

                $sequence[] = [
                    'user_id' => $user->id,
                    'team_id' => rand(1, $teamCount),
                    'pitch_role' => fake()->randomElement(PitchRoles::class),
                    'contract_signed_at' => $contractSigned,
                    'contract_terminated_at' => $contractTerminated,
                    'status' => $isLast ? 'active' : 'inactive',
                ];
            }

            foreach ($sequence as $data) {
                TeamUser::factory()->create($data);
            }
        });
    }
}
