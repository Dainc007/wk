<?php

declare(strict_types=1);

namespace App\Filament\App\Widgets;

use Filament\Widgets\Widget;

final class NextEventWidget extends Widget
{
    protected static string $view = 'filament.app.widgets.next-event-widget';

    protected int|string|array $columnSpan = 1;

    public function getNextEvent(): null
    {
        return null;
    }

    protected function getViewData(): array
    {
        $this->getNextEvent();

        return [
            'hasGame' => false,
            'message' => 'No upcoming games scheduled',
        ];
    }
}
