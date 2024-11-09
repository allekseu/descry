<?php

declare(strict_types=1);

namespace Descry\KBS\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ResponseException extends Exception
{
    /**
     * @param  string  $message
     * @return void
     */
    public function __construct(string $message)
    {
        parent::__construct("API Response Error: {$message}", Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
