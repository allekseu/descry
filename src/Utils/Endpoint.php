<?php

declare(strict_types=1);

namespace Descry\Utils;

use Illuminate\Support\Str;

/**
 * @method object format(array $endpoint, array $parameters = [])
 */
class Endpoint
{
    /**
     * @var string
     */
    public const string METHOD_GET = "GET";

    /**
     * @var string
     */
    public const string METHOD_POST = "POST";

    /**
     * @var array
     */
    public const array KBS_GET_STREAM = [
        "method" => self::METHOD_GET,
        "url" => "landing/live/channel_code/?"
    ];

    /**
     * @var array
     */
    public const array KBS_GET_SCHEDULE_REGULAR = [
        "method" => self::METHOD_GET,
        "url" => "schedule/weekly"
    ];

    /**
     * @var array
     */
    public const array KBS_GET_SCHEDULE_VOD = [
        "method" => self::METHOD_GET,
        "url" => "myk/weekly"
    ];

    /**
     * @var object
     */
    public static function format(array $endpoint, array $parameters = []): object
    {
        return (object) [
            "method" => $endpoint["method"],
            "url" => Str::replaceArray("?", $parameters, $endpoint["url"])
        ];
    }
}
