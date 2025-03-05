<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Roles
        $superAdmin = Role::firstOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'web',
        ]);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $moderatorRole = Role::firstOrCreate([
            'name' => 'moderator',
            'guard_name' => 'web',
        ]);

        $leagueManagerRole = Role::firstOrCreate([
            'name' => 'league-manager',
            'guard_name' => 'web',
        ]);

        $teamManagerRole = Role::firstOrCreate([
            'name' => 'team-manager',
            'guard_name' => 'web',
        ]);

        // Assign permissions based on roles
        $superAdmin->syncPermissions(Permission::all());

        $adminRole->syncPermissions([
            // Admin can do almost everything except super-admin level actions
            'league_view',
            'league_create',
            'league_edit',
            'team_view',
            'team_create',
            'team_edit',
            'player_view',
            'player_create',
            'player_edit',
            'match_view',
            'match_create',
            'match_edit',
            'match_score_update',
            'user_view',
            'user_create',
            'user_edit',
        ]);

        $moderatorRole->syncPermissions([
            'league_view',
            'team_view',
            'player_view',
            'match_view',
            'match_score_update',
        ]);

        $leagueManagerRole->syncPermissions([
            'league_view',
            'league_edit',
            'team_view',
            'team_create',
            'team_edit',
            'player_view',
            'player_create',
            'player_edit',
            'match_view',
            'match_create',
            'match_edit',
            'match_score_update',
        ]);

        $teamManagerRole->syncPermissions([
            'team_view',
            'team_edit',
            'player_view',
            'player_create',
            'player_edit',
            'match_view',
            'match_score_update',
        ]);
    }
}
