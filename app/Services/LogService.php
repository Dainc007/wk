<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class LogService
{
    public static function shouldLogMissingTranslationKeys($logMissingTranslationKeys = false): void
    {
        if($logMissingTranslationKeys) {
            Lang::handleMissingKeysUsing(function ($key, $replace, $locale, $fallback) {
                Log::error("Missing translation key: {$key} in locale: {$locale}");
            });
        }
    }
}
