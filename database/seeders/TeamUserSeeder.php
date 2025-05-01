<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\TeamUser;
use Illuminate\Database\Seeder;

final class TeamUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamUser::factory()->count(1000)->create();
    }
}
