<?php

declare(strict_types=1);

namespace Descry\Utils;

use Illuminate\Support\Str;

/**
 * @method static  hydrate(...$parameters)
 * @method array   toArray()
 */
class DTO
{
    /**
     * @param  array  $instance
     * @return void
     */
    public function __construct($instance)
    {
        $this->create($instance);
    }

    /**
     * @param  array  $parameters
     * @return self
     */
    private function create(array $parameters = []): self
    {
        foreach($parameters as $key => $value) {
            if (property_exists($this, Str::camel($key))) {
                $value = $this->sanitize($value);

                $function = "set" . Str::studly($key);
                $this->$function($value);
            }
        }

        return $this;
    }

    /**
     * @param  mixed  $value
     * @return mixed
     */
    private function sanitize(mixed $value): mixed
    {
        if (is_string($value)) {
            $value = Str::squish($value);

            if ($value === "") {
                $value = null;
            }
        }

        return $value;
    }

    /**
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
}
