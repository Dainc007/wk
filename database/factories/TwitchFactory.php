<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Twitch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Twitch>
 */
class TwitchFactory extends Factory
{
    /**
     * List of popular Twitch streamers
     */
    protected const POPULAR_TWITCH_ACCOUNTS = [
        'xQc', 'Ninja', 'shroud', 'pokimane', 'auronplay', 'ibai', 'TheGrefg', 'Rubius', 
        'sodapoppin', 'summit1g', 'Tfue', 'NICKMERCS', 'Asmongold', 'TimTheTatman', 'DrLupo', 
        'Myth', 'DrDisrespect', 'ludwig', 'HasanAbi', 'moistcr1tikal', 'Sykkuno', 
        'CohhCarnage', 'MOONMOON', 'Kripparrian', 'AdmiralBulldog', 'Forsen', 'Jerma985', 
        'LIRIK', 'Mizkif', 'Amouranth', 'Valkyrae', 'tommyinnit', 'Dream', 'Philza', 
        'GeorgeNotFound', 'Tubbo', 'Ranboo', 'Wilbursoot', 'KSI', 'elrubiusOMG',
        'TypicalGamer', 'SypherPK', 'CouRage', 'DisguisedToast', '39daph', 'nmplol',
        'cyr', 'AustinShow', 'QTCinderella', 'Alinity', 'xChocoBars', 'Fuslie', 'Masayoshi',
        'BaboAbe', 'scarra'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $twitchNames = null;
        
        if ($twitchNames === null) {
            $twitchNames = collect(self::POPULAR_TWITCH_ACCOUNTS)->unique()->toArray();
        }
        
        // If we've used up all the predefined names, generate a random one
        if (empty($twitchNames)) {
            return [
                'name' => $this->faker->userName() . mt_rand(1000, 9999),
                'is_live' => $this->faker->boolean(20), // 20% chance of being live
                'twitchable_type' => User::class,
                'twitchable_id' => User::factory(),
            ];
        }
        
        // Take a random name from the array and remove it to ensure uniqueness
        $randomIndex = array_rand($twitchNames);
        $name = $twitchNames[$randomIndex];
        unset($twitchNames[$randomIndex]);
        $twitchNames = array_values($twitchNames);
        
        return [
            'name' => $name,
            'is_live' => $this->faker->boolean(20), // 20% chance of being live
            'twitchable_type' => User::class,
            'twitchable_id' => User::factory(),
        ];
    }
    
    /**
     * Configure the factory to associate the Twitch account with a specific user.
     */
    public function forUser(User $user)
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'twitchable_id' => $user->id,
                'twitchable_type' => User::class,
            ];
        });
    }
}
