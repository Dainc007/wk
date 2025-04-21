<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\RankingResource\Pages;

use App\Filament\App\Resources\RankingResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateRanking extends CreateRecord
{
    protected static string $resource = RankingResource::class;
}
