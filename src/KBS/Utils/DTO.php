<?php

declare(strict_types=1);

namespace Descry\KBS\Utils;

use Illuminate\Support\Str;

/**
 * @method static hydrate(...$parameters)
 * @method array toArray()
 */
class DTO
{
    /**
     * @param array $apiResponse
     * @return void
     */
    public function __construct($instance)
    {
        $this->create($instance);
    }

    /**
     * Create a new resource instance.
     *
     * @param  mixed  ...$parameters
     * @return static
     */
    public static function hydrate(...$parameters): static
    {
        return new static(...$parameters);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @param array $parameters
     * @return self
     */
    protected function create(array $parameters = []): self
    {
        foreach($parameters as $key => $value) {
            $key = Str::camel($key);

            if (property_exists($this, $key)) {
                $function = "set" . Str::ucfirst($key);
                $this->$function($value);
            }
        }

        return $this;
    }
}
