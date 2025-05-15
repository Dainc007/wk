<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\StatisticResource\Pages;

use App\Filament\Admin\Resources\StatisticResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateStatistic extends CreateRecord
{
    protected static string $resource = StatisticResource::class;
}
