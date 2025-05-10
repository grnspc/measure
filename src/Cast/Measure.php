<?php

declare(strict_types=1);

namespace Grnspc\Measures\Cast;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;
use Grnspc\Measures\Facades\Measures;

/* @phpstan-ignore-next-line */
class Measure implements CastsAttributes
{
    /**
     * @return \Grnspc\Measures\Unit\Measure|null
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        /* @phpstan-ignore-next-line */
        return Measures::from($value);
    }

    public function set($model, string $key, $value, array $attributes): ?string
    {
        if (is_null($value)) {
            return null;
        }
        if (! $value instanceof \Grnspc\Measures\Unit\Measure) {
            throw new InvalidArgumentException("The value must be an instance of Grnspc\Measures\Unit\Measure");
        }

        return (string) $value;
    }
}
