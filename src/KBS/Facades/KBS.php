<?php

namespace Descry\KBS\Facades;

use Descry\KBS\Client;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Descry\KBS\Client
 *
 * @method static \Descry\KBS\Responses\ScheduleResponse getSchedule()
 * @method static \Descry\KBS\Responses\StreamResponse getStream()
 */
class KBS extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
