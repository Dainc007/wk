<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // League Permissions
        $leaguePermissions = [
            'league_view',
            'league_create',
            'league_edit',
            'league_delete',
        ];

        // Team Permissions
        $teamPermissions = [
            'team_view',
            'team_create',
            'team_edit',
            'team_delete',
        ];

        // Player Permissions
        $playerPermissions = [
            'player_view',
            'player_create',
            'player_edit',
            'player_delete',
        ];

        // Match/Event Permissions
        $matchPermissions = [
            'match_view',
            'match_create',
            'match_edit',
            'match_delete',
            'match_score_update',
        ];

        // User Management Permissions
        $userPermissions = [
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',
        ];

        // Combine all permissions
        $allPermissions = array_merge(
            $leaguePermissions,
            $teamPermissions,
            $playerPermissions,
            $matchPermissions,
            $userPermissions
        );

        // Create permissions
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}
