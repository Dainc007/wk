<x-filament-widgets::widget>
    <x-filament::section>
        @if($hasGame)
            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <div class="flex items-center space-x-4">
                    <!-- Team logo -->
                    <div class="flex-shrink-0">
                        @if ($isHome)
                            <div class="h-16 w-16 rounded-full bg-primary-500 flex items-center justify-center">
                                <span class="text-white font-bold">Our Team</span>
                            </div>
                        @else
                            <div class="h-16 w-16 rounded-full bg-primary-100 flex items-center justify-center">
                                <span class="text-primary-700 font-bold">Our Team</span>
                            </div>
                        @endif
                    </div>

                    <!-- Game details -->
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $isHome ? 'Home vs' : 'Away at' }} {{ $game->opponent->name }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $formattedDate }}
                        </p>
                        <p class="text-xs text-primary-500 font-medium">
                            {{ $daysUntil }} days until game day
                        </p>
                    </div>
                </div>

                <!-- Opponent logo -->
                <div class="flex-shrink-0">
                    @if($game->opponent->logo_url)
                        <img src="{{ $game->opponent->logo_url }}" alt="{{ $game->opponent->name }}"
                             class="h-16 w-16 rounded-full object-cover border-2 {{ $isHome ? 'border-gray-300' : 'border-primary-500' }}">
                    @else
                        <div
                            class="h-16 w-16 rounded-full bg-gray-300 dark:bg-gray-700 flex items-center justify-center {{ $isHome ? '' : 'border-2 border-primary-500' }}">
                            <span
                                class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ substr($game->opponent->name, 0, 2) }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Optional call to action -->
            <div class="mt-2 flex justify-end">
                <a href="{{ route('filament.resources.games.view', $game->id) }}"
                   class="text-sm text-primary-600 hover:text-primary-500">
                    View details →
                </a>
            </div>
        @else
            <div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-col items-center justify-center">
                <p class="text-center text-lg font-medium text-gray-600 dark:text-gray-300 mb-4">
                    {{ $message }}
                </p>

                <!-- Soccer Ball Animation -->
                <div class="soccer-ball-container">
                    <div class="soccer-ball"></div>
                </div>
            </div>

            <!-- CSS for soccer ball animation -->
            <style>
                .soccer-ball-container {
                    display: flex;
                    justify-content: center;
                    width: 100%;
                    height: 100px;
                    perspective: 400px;
                }

                .soccer-ball {
                    width: 60px;
                    height: 60px;
                    background: radial-gradient(circle at 30% 30%, white, #cdcdcd);
                    border-radius: 50%;
                    position: relative;
                    animation: bounce 1.5s ease infinite;
                    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                }

                .soccer-ball::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: url('https://cdn0.iconfinder.com/data/icons/sports-59/512/Soccer-1024.png') no-repeat center center;
                    background-size: cover;
                    border-radius: 50%;
                }

                @keyframes bounce {
                    0%, 100% {
                        transform: translateY(0);
                        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                    }
                    50% {
                        transform: translateY(-20px);
                        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4); /* Zwiększenie cienia przy podskoku */
                    }
                }
            </style>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
