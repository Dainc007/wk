<?php

declare(strict_types=1);

namespace App\Filament\Traits;

trait HasTranslatedLabels
{
    public static function getNavigationLabel(): string
    {
        return __('filament.resources.' . static::getResourceName() . '.navigation.label');
    }

    public static function getModelLabel(): string
    {
        return __('filament.resources.' . static::getResourceName() . '.model.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament.resources.' . static::getResourceName() . '.model.plural_label');
    }

    protected static function getResourceName(): string
    {
        return strtolower(class_basename(static::getModel()));
    }
}
