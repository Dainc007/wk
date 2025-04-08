<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

final class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'super-admin' => [],
            'admin' => [
                'league_view', 'league_create', 'league_edit',
                'team_view', 'team_create', 'team_edit',
                'player_view', 'player_create', 'player_edit',
                'match_view', 'match_create', 'match_edit', 'match_score_update',
                'user_view', 'user_create', 'user_edit',
            ],
            'moderator' => [
                'league_view', 'team_view', 'player_view',
                'match_view', 'match_score_update',
            ],
            'league-manager' => [
                'league_view', 'league_edit',
                'team_view', 'team_create', 'team_edit',
                'player_view', 'player_create', 'player_edit',
                'match_view', 'match_create', 'match_edit', 'match_score_update',
            ],
            'team-manager' => [
                'team_view', 'team_edit',
                'player_view', 'player_create', 'player_edit',
                'match_view', 'match_score_update',
            ],
            'player' => [
                'league_view', 'league_edit',
            ],
            'user' => [
                'view_any_user',
                'view_user',
                'language_edit',
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            if ($roleName === 'super-admin') {
                $role->syncPermissions(Permission::all());
            } elseif (! empty($permissions)) {
                $role->syncPermissions($permissions);
            }
        }
    }
}
