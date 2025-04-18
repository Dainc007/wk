<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Twitch;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TwitchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Count users and ensure we don't try to create more Twitch accounts than there are users
        $userCount = User::count();
        $maxTwitchAccounts = min(50, $userCount);
        
        // Get users without Twitch accounts, limited to reasonable number
        $users = User::doesntHave('twitch')->inRandomOrder()->take($maxTwitchAccounts)->get();
        
        // Create Twitch accounts for these users
        foreach ($users as $user) {
            Twitch::factory()->forUser($user)->create();
        }
        
        // Make sure some popular Twitch accounts are created
        $popularTwitchAccounts = [
            'shroud',
            'pokimane',
            'xQc',
            'Ninja',
            'TimTheTatman',
            'Asmongold',
            'ludwig',
            'HasanAbi',
            'DrDisrespect',
            'LIRIK'
        ];
        
        foreach ($popularTwitchAccounts as $accountName) {
            // Check if this account name already exists
            if (!Twitch::where('name', $accountName)->exists()) {
                // Find a user without a Twitch account
                $user = User::doesntHave('twitch')->inRandomOrder()->first();
                
                if ($user) {
                    $user->twitch()->create([
                        'name' => $accountName,
                        'is_live' => rand(0, 100) < 20 // 20% chance of being live
                    ]);
                }
            }
        }
    }
}
