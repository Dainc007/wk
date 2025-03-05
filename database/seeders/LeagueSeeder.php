<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Countries;
use App\Models\League;
use Illuminate\Database\Seeder;

final class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Countries::cases() as $country) {
            for ($level = 0; $level <= 2; $level++) {
                League::create([
                    'name' => $country->name,
                    'country' => $country->value,
                    'level' => $level,
                ]);
            }
        }
    }
}
