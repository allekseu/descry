<?php

declare(strict_types=1);

namespace Descry\KBS\Utils;

use Illuminate\Support\Facades\Cache;

/**
 * @method bool hasDrm(?string $trackUrl)
 */
class Scrapper
{
    /**
     * @param string|null $trackUrl
     * @return bool
     */
    public static function hasDrm(?string $trackUrl): bool
    {
        return $trackUrl ? Cache::remember("kbs.track.drm." . explode("?", $trackUrl)[0], 60*60, function () use ($trackUrl) {
            return str_contains(file_get_contents($trackUrl), "EXT-X-KEY");
        }) : false;
    }
}
