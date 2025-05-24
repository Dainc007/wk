<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\StatisticTypeResource\Pages;

use App\Filament\Admin\Resources\StatisticTypeResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateStatisticType extends CreateRecord
{
    protected static string $resource = StatisticTypeResource::class;
}
