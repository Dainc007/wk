<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\UserResource\Pages;

use App\Filament\App\Resources\UserResource;
use App\Filament\App\Widgets\CalendarWidget;
use App\Filament\App\Widgets\LatestStreamers;
use App\Filament\App\Widgets\StatsOverview;
use App\Filament\App\Widgets\UserPlayedGamesWidget;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\View\View;

final class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    public function render(): View
    {
        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->record)
            ->event('view')
            ->log('User '.auth()->user()->name.' viewed '.$this->record->name);

        return parent::render();
    }

    protected function getFooterWidgets(): array
    {
        return [
            StatsOverview::class,
            UserPlayedGamesWidget::class,
            LatestStreamers::class,
            CalendarWidget::class,
        ];
    }
}
