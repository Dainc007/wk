<?php

declare(strict_types=1);

namespace App\Filament\App\Resources\RankingResource\Pages;

use App\Filament\App\Resources\RankingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

final class EditRanking extends EditRecord
{
    protected static string $resource = RankingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
