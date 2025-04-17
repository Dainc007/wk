<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! User::where('email', 'test@example.com')->exists()) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

            $user->twitch()->create([
                'name' => 'izakooo',
            ]);

            $user->discord()->create([
                'name' => 'izakooo',
            ]);

            $roles = Role::all();
            $roleNames = $roles->pluck('name')->toArray();
            $user->assignRole($roleNames);
        }

        if (! User::where('email', 'danielheinze96@gmail.com')->exists()) {
            $user = User::factory()->create([
                'name' => 'Daniel Heinze',
                'email' => 'danielheinze96@gmail.com',
            ]);

            $user->twitch()->create([
                'name' => 'heinzei14i',
            ]);

            $user->discord()->create([
                'name' => 'heinzei14i',
            ]);

            $roles = Role::all();
            $roleNames = $roles->pluck('name')->toArray();
            $user->assignRole($roleNames);
        }

        User::factory(1000)->create();
    }
}
