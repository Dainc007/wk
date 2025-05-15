<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PitchRoles: string implements HasColor, HasIcon, HasLabel
{
    case STAR = 'Star';
    case FIRST_ELEVEN = 'First Eleven';
    case IMPORTANT = 'Important';
    case SUBSTITUTE = 'Substitute';
    case ROTATE = 'Rotate';
    case SQUAD_DEPTH = 'Squad Depth';

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::STAR => 'heroicon-m-star',
            self::IMPORTANT => 'heroicon-m-eye',
            self::FIRST_ELEVEN => 'heroicon-m-check',
            self::ROTATE => 'heroicon-m-pencil',
            self::SQUAD_DEPTH => 'heroicon-m-pencil',
            self::SUBSTITUTE => 'heroicon-m-user',
            default => null,
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::STAR => 'success',
            self::IMPORTANT => 'warning',
            self::FIRST_ELEVEN => 'gray',
            default => null,
        };
    }
}
