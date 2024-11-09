<?php

declare(strict_types=1);

namespace Descry\KBS\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ValidationException extends Exception
{
    /**
     * @param  string  $parameter
     * @return void
     */
    public function __construct(string $parameter)
    {
        parent::__construct("Missing request parameter: {$parameter}", Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
