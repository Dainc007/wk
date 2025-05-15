<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\League;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class TeamRolePermissionTest extends TestCase
{
    use RefreshDatabase;

    private User $player;

    private User $manager;

    private Team $team;

    private League $league;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles if they don't exist
        $this->player = User::factory()->create();
        $this->player->assignRole('player');

        $this->manager = User::factory()->create();
        $this->manager->assignRole('manager');

        $this->team = Team::factory()->create();
        $this->league = League::factory()->create();
    }

    public function test_player_can_join_team(): void
    {
        $this->actingAs($this->player);

        $response = $this->post(route('teams.join', $this->team));

        $response->assertSuccessful();
        $this->assertTrue($this->player->teams->contains($this->team));
    }

    public function test_player_cannot_join_multiple_teams_in_same_league(): void
    {
        $this->actingAs($this->player);

        // Create another team in the same league
        $team2 = Team::factory()->create();
        $this->team->leagues()->attach($this->league);
        $team2->leagues()->attach($this->league);

        // Join first team
        $this->post(route('teams.join', $this->team));

        // Try to join second team
        $response = $this->post(route('teams.join', $team2));

        $response->assertForbidden();
        $this->assertFalse($this->player->teams->contains($team2));
    }

    public function test_player_cannot_join_multiple_teams_in_same_competition(): void
    {
        $this->actingAs($this->player);

        // Create another team in the same competition
        $team2 = Team::factory()->create();
        $competition = Competition::factory()->create();
        $this->team->competitions()->attach($competition);
        $team2->competitions()->attach($competition);

        // Join first team
        $this->post(route('teams.join', $this->team));

        // Try to join second team
        $response = $this->post(route('teams.join', $team2));

        $response->assertForbidden();
        $this->assertFalse($this->player->teams->contains($team2));
    }

    public function test_manager_can_edit_own_team(): void
    {
        $this->actingAs($this->manager);
        $this->manager->teams()->attach($this->team);

        $response = $this->put(route('teams.update', $this->team), [
            'name' => 'Updated Team Name',
        ]);

        $response->assertSuccessful();
        $this->assertEquals('Updated Team Name', $this->team->fresh()->name);
    }

    public function test_manager_cannot_edit_other_teams(): void
    {
        $this->actingAs($this->manager);
        $otherTeam = Team::factory()->create();

        $response = $this->put(route('teams.update', $otherTeam), [
            'name' => 'Updated Team Name',
        ]);

        $response->assertForbidden();
        $this->assertNotEquals('Updated Team Name', $otherTeam->fresh()->name);
    }

    public function test_manager_can_invite_players_to_own_team(): void
    {
        $this->actingAs($this->manager);
        $this->manager->teams()->attach($this->team);
        $newPlayer = User::factory()->create();

        $response = $this->post(route('teams.invite', $this->team), [
            'email' => $newPlayer->email,
        ]);

        $response->assertSuccessful();
        // Assert invitation was created
        $this->assertDatabaseHas('team_invitations', [
            'team_id' => $this->team->id,
            'email' => $newPlayer->email,
        ]);
    }

    public function test_manager_cannot_invite_players_to_other_teams(): void
    {
        $this->actingAs($this->manager);
        $otherTeam = Team::factory()->create();
        $newPlayer = User::factory()->create();

        $response = $this->post(route('teams.invite', $otherTeam), [
            'email' => $newPlayer->email,
        ]);

        $response->assertForbidden();
        $this->assertDatabaseMissing('team_invitations', [
            'team_id' => $otherTeam->id,
            'email' => $newPlayer->email,
        ]);
    }

    public function test_manager_can_remove_players_from_own_team(): void
    {
        $this->actingAs($this->manager);
        $this->manager->teams()->attach($this->team);
        $player = User::factory()->create();
        $player->teams()->attach($this->team);

        $response = $this->delete(route('teams.remove-player', [
            'team' => $this->team,
            'user' => $player,
        ]));

        $response->assertSuccessful();
        $this->assertFalse($player->teams->contains($this->team));
    }

    public function test_manager_cannot_remove_players_from_other_teams(): void
    {
        $this->actingAs($this->manager);
        $otherTeam = Team::factory()->create();
        $player = User::factory()->create();
        $player->teams()->attach($otherTeam);

        $response = $this->delete(route('teams.remove-player', [
            'team' => $otherTeam,
            'user' => $player,
        ]));

        $response->assertForbidden();
        $this->assertTrue($player->teams->contains($otherTeam));
    }
}
