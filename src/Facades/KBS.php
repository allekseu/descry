<?php

namespace Descry\Facades;

use Descry\KBS\Client;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Descry\KBS\Client
 *
 * @method static \Descry\KBS\Responses\ListingResponse getListing(\Descry\KBS\Utils\Parameters $parameters)
 * @method static \Descry\KBS\Responses\StreamResponse getStream(\Descry\KBS\Utils\Parameters $parameters)
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
