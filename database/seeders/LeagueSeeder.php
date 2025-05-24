<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Federation;
use Illuminate\Database\Seeder;

// todo AI generated. double check it

final class LeagueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Federation::all() as $federation) {
            $leagues = [];
            for ($level = 1; $level <= 2; $level++) {
                $leagues[] = [
                    'name' => 'Liga '.$level,
                    'region' => $federation->region.'_'.uniqid(),
                    'level' => $level,
                    'federation_id' => $federation->id,
                ];
            }
            $federation->leagues()->insert($leagues);
        }
    }
}
