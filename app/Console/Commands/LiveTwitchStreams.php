<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\SocialPlatform;
use App\Models\Twitch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

final class LiveTwitchStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:live-twitch-streams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Twitch::query()->each(function (Twitch $twitch): void {
            $url = SocialPlatform::TWITCH->getBaseUrl().urlencode($twitch->name);

            $html = Http::get($url)->body();

            $twitch->update([
                'is_live' => mb_strpos($html, '"isLiveBroadcast":true') !== false,
            ]);
        });
    }
}
